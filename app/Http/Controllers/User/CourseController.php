<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseChapterInterface;
use App\Interfaces\CourseInterface;
use App\Interfaces\QuizInterface;
use App\Models\Course\Quiz\UserQuizAttempt;
use App\Models\Course\UserCourseAccessLog;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $course;
    private $courseChapter;
    private $quiz;

    public function __construct(CourseInterface $course, QuizInterface $quiz, CourseChapterInterface $courseChapter)
    {
        $this->course        = $course;
        $this->quiz          = $quiz;
        $this->courseChapter = $courseChapter;
    }

    public function detail($id, $page)
    {
        $course              = $this->course->getById($id);
        $course->is_complete = $this->course->isCompleted($id);

        foreach ($course->courseChapter as $chapter) {
            $chapter->is_complete = $this->courseChapter->isCompleted($chapter->id);
            if ($chapter->quiz) {
                $chapter->quiz->is_complete = $this->quiz->isCompleted($chapter->quiz->id);
            }
        }

        return view('user.learning.index', [
            'course'   => $course,
            'learning' => $this->courseChapter->getById($page),
        ]);
    }

    /* 
        Metode ini digunakan untuk menandai bahwa user telah menyelesaikan chapter dari course yang sedang diaksesnya.
        Jika chapter yang diakses adalah chapter terakhir dari course, maka course akan ditandai sebagai selesai.
        Jika chapter yang diakses bukan chapter terakhir dari course, maka user akan diarahkan ke chapter selanjutnya.
    */
    public function courseChapterComplete($id)
    {
        $chapter                  = $this->courseChapter->getById($id);
        $chapter->next_chapter_id = $this->courseChapter->getNextChapterId($id);

        // cek jika chapter sudah pernah diakses sebelumnya
        $userAccessLog = UserCourseAccessLog::where([
            'user_id'           => auth()->user()->id,
            'course_id'         => $chapter->course_id,
            'course_chapter_id' => $id,
        ])->first();

        // jika belum pernah diakses, maka buat log akses baru
        if (!$userAccessLog) {
            UserCourseAccessLog::create([
                'user_id'           => auth()->user()->id,
                'course_id'         => $chapter->course_id,
                'course_chapter_id' => $id,
            ]);
        }

        // cek jika chapter selanjutnya adalah quiz
        if ($chapter->quiz) {
            return redirect()->route('user.course.quiz', $chapter->quiz->id);
        }

        // cek jika chapter adalah chapter terakhir dari course
        if ($chapter->is_last) {
            return redirect()->route('user.dashboard')->with('finish', 'Course telah selesai.');
        }

        // jika chapter selanjutnya bukan quiz, maka arahkan ke chapter selanjutnya
        return redirect()->route('user.course.detail', [$chapter->course_id, $chapter->next_chapter_id]);
    }

    public function quiz($id)
    {
        $quiz                = $this->quiz->getById($id);
        $course              = $this->course->getById($quiz->courseChapter->course->id);
        $course->is_complete = $this->course->isCompleted($course->id);

        foreach ($course->courseChapter as $chapter) {
            $chapter->is_complete = $this->courseChapter->isCompleted($chapter->id);
            if ($chapter->quiz) {
                $chapter->quiz->is_complete = $this->quiz->isCompleted($chapter->quiz->id);
            }
        }

        return view('user.learning.quiz', [
            'course' => $course,
            'quiz'   => $quiz,
        ]);
    }

    /* 
        Metode ini digunakan untuk menandai bahwa user telah menyelesaikan quiz dari course yang sedang diaksesnya.
        Jika quiz yang diakses adalah quiz terakhir dari course, maka course akan ditandai sebagai selesai.
        Jika quiz yang diakses bukan quiz terakhir dari course, maka user akan diarahkan ke chapter selanjutnya.
    */
    public function quizFinish($id, Request $request)
    {
        $quiz                                 = $this->quiz->getById($id);
        $quiz->courseChapter->next_chapter_id = $this->courseChapter->getNextChapterId($quiz->courseChapter->id);
        $is_correct                           = $this->quiz->checkAnswer($id, $request->answer);

        if ($is_correct) {
            $userQuizAttempt = UserQuizAttempt::where([
                'user_id' => auth()->user()->id,
                'quiz_id' => $id,
            ])->first();

            // jika belum pernah diakses, maka buat log akses baru
            if (!$userQuizAttempt) {
                UserQuizAttempt::create([
                    'user_id' => auth()->user()->id,
                    'quiz_id' => $id,
                ]);
            }

            // cek jika masih ada chapter selanjutnya
            if ($quiz->courseChapter->next_chapter_id) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Jawaban benar. Anda akan diarahkan ke chapter selanjutnya.',
                    'next'    => route('user.course.detail', [$quiz->courseChapter->course_id, $quiz->courseChapter->next_chapter_id]),
                ]);
            }

            // jika tidak ada chapter selanjutnya, maka tandai course sebagai selesai
            return response()->json([
                'status'  => true,
                'message' => 'Course telah selesai. Anda akan diarahkan ke halaman course.',
                'next'    => route('user.dashboard'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Jawaban salah. Silahkan coba lagi.'
            ]);
        }
    }

    public function show($id)
    {
        $course           = $this->course->getById($id);
        $techSpecs        = $course->courseTechSpec;
        $benefits         = $course->courseBenefit;
        $courseObjectives = $course->courseObjective;
        $authors          = $course->author;
        $isBought         = $course->isBought;
        $carts            = session()->get('cart');
        $discount         = $this->course->discount($id);
        // get discount that is not expired yet
        $discount = $discount->filter(function ($discount) {
            return $discount->end_date > now() && $discount->start_date < now() && $discount->role == auth()->user()->role;
        })->first();

        if ($carts != null) {
            $carts = array_filter($carts, function ($cart) {
                return $cart['user_id'] == auth()->user()->id;
            });

            // change to array
            $carts = array_values($carts);

            // check if course is in cart
            $course->isInCart = false;
            foreach ($carts as $cart) {
                if ($cart['id'] == $id) {
                    $course->isInCart = true;
                    break;
                }
            }
        }

        return view('detail-product', compact('course', 'techSpecs', 'benefits', 'courseObjectives', 'authors', 'isBought', 'carts', 'discount'));
    }
}
