<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseInterface;
use App\Models\Course\UserCourseAccessLog;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $course;

    public function __construct(CourseInterface $course)
    {
        $this->course = $course;
    }

    public function index($id, $page = 1)
    {
        $course        = $this->course->getById($id);
        $learnProgress = $this->course->getLearnProgress($id, auth()->id());

        $courseChapters = $course->courseChapter;
        $chapter        = $this->getChapterByPage($courseChapters, $page);

        $this->updateChapterInfo($courseChapters);

        $previousChapter = $this->getPreviousChapter($courseChapters, $chapter);
        $nextChapter     = $this->getNextChapter($courseChapters, $chapter);
        $isLastChapter   = $chapter->orderNumber == $courseChapters->count();

        // return [
        //     'course'          => $course,
        //     'learnProgress'   => $learnProgress,
        //     'chapter'         => $chapter,
        //     'previousChapter' => $previousChapter,
        //     'nextChapter'     => $nextChapter,
        // ];

        return view('user.course.index', compact(
            'course',
            'learnProgress',
            'chapter',
            'page',
            'previousChapter',
            'nextChapter',
            'isLastChapter'
        ));
    }

    private function getChapterByPage($chapters, $page)
    {
        return $chapters->skip($page - 1)->first();
    }

    private function updateChapterInfo($chapters)
    {
        $chapters->each(function ($item, $key) use ($chapters) {
            $item->orderNumber = $chapters->search($item) + 1;
            $item->isLearned   = $this->course->isLearned($item->id, auth()->id());

            if ($key > 0) {
                $item->isPreviousLearned = $this->course->isLearned($chapters[$key - 1]->id, auth()->id());
            }
        });
    }

    private function getPreviousChapter($chapters, $chapter)
    {
        return $chapter->orderNumber > 1 ? $chapters[$chapter->orderNumber - 2] : null;
    }

    private function getNextChapter($chapters, $chapter)
    {
        return $chapter->orderNumber < $chapters->count() ? $chapters[$chapter->orderNumber] : null;
    }

    public function nextPage($id, $page)
    {
        // Check if user has access to this course
        $course = $this->course->getById($id);
        $chapter = $this->getChapterByPage($course->courseChapter, $page);

        $this->updateChapterInfo($course->courseChapter);

        $isLastChapter = $chapter->orderNumber == $course->courseChapter->count();

        // Create user course access log, if not exists
        $userAccessLog = UserCourseAccessLog::where('user_id', auth()->id())
            ->where('course_id', $id)
            ->where('course_chapter_id', $chapter->id)
            ->first();

        if ($isLastChapter) {
            if (!$userAccessLog) {
                UserCourseAccessLog::create([
                    'user_id'            => auth()->id(),
                    'course_id'          => $id,
                    'course_chapter_id'  => $chapter->id,
                ]);
            }
            return redirect()->route('user.dashboard')->with('finish', 'Selamat Anda telah menyelesaikan kursus ini');
        }

        // Check if chapter is already learned
        if ($this->course->isLearned($chapter->id, auth()->id())) {
            return redirect()->route('user.course.detail', [$id, $page + 1]);
        }

        if (!$userAccessLog) {
            UserCourseAccessLog::create([
                'user_id'            => auth()->id(),
                'course_id'          => $id,
                'course_chapter_id'  => $chapter->id,
            ]);
        }

        // If not the last chapter, proceed to the next chapter
        return redirect()->route('user.course.detail', [$id, $page + 1]);
    }

    // show 
    public function show($id)
    {
        $course = $this->course->getById($id);
        $techSpecs = $course->courseTechSpec;
        $benefits = $course->courseBenefit;
        $courseObjectives = $course->courseObjective;
        $authors = $course->author;

        return view('detail-product', compact('course', 'techSpecs', 'benefits', 'courseObjectives', 'authors'));
    }
}
