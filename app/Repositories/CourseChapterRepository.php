<?php

namespace App\Repositories;

use App\Interfaces\CourseChapterInterface;
use App\Models\Course\Course;
use App\Models\Course\CourseChapter;
use App\Models\Course\Quiz\UserQuizAttempt;
use App\Models\Course\UserCourseAccessLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseChapterRepository implements CourseChapterInterface
{
    private $course;
    private $courseChapter;

    public function __construct(Course $course, CourseChapter $courseChapter)
    {
        $this->course        = $course;
        $this->courseChapter = $courseChapter;
    }

    public function getAll($courseId)
    {
        return $this->courseChapter->with(['quiz'])->where('course_id', $courseId)->get();
    }

    public function getById($id)
    {
        $courseChapter = $this->courseChapter->with('course')->find($id);
        $courseChapter->is_complete = $this->isCompleted($id);
        $courseChapter->is_first    = $this->courseChapter->where('course_id', $courseChapter->course_id)->first()->id == $id ? true : false;
        $courseChapter->is_last     = $this->courseChapter->where('course_id', $courseChapter->course_id)->latest()->first()->id == $id ? true : false;

        return $courseChapter;
    }

    public function getNextChapterId($id)
    {
        $courseChapter = $this->courseChapter->find($id);
        $nextChapterId = $this->courseChapter->where('course_id', $courseChapter->course_id)->where('id', '>', $id)->first()->id ?? null;
        return $nextChapterId;
    }

    public function store($data, $courseId)
    {
        DB::beginTransaction();

        if (isset($data['pdf_file'])) {
            $pdfFilename = uniqid() . '-' . time() . '.' . $data['pdf_file']->extension();
            $data['pdf_file']->storeAs('public/course/chapter/pdf', $pdfFilename);
        }

        if (isset($data['video_file'])) {
            $videoFilename = uniqid() . '-' . time() . '.' . $data['video_file']->extension();
            $data['video_file']->storeAs('public/course/chapter/video', $videoFilename);
        }

        if (isset($data['scrom_file'])) {
        }

        try {

            $courseChapter = $this->courseChapter->create([
                'course_id'   => $courseId,
                'title'       => $data['title'],
                'description' => $data['description'],
                'pdf_file'    => $pdfFilename ?? null,
                'video_file'  => $videoFilename ?? null,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            // Delete the uploaded files
            if (isset($pdfFilename)) {
                Storage::delete('public/course/chapter/pdf/' . $pdfFilename);
            }

            if (isset($videoFilename)) {
                Storage::delete('public/course/chapter/video/' . $videoFilename);
            }

            dd($th->getMessage());
            throw $th;
        }
    }

    public function update($data, $id)
    {
        // dd($data);
        DB::beginTransaction();

        $courseChapter = $this->courseChapter->find($id);

        $pdfFilename   = $courseChapter->pdf_file;
        $videoFilename = $courseChapter->video_file;

        try {
            if (isset($data['pdf_file'])) {
                $pdfFilename = uniqid() . '-' . time() . '.' . $data['pdf_file']->extension();
                $data['pdf_file']->storeAs('public/course/chapter/pdf', $pdfFilename);

                // Delete the old file
                Storage::delete('public/course/chapter/pdf/' . $courseChapter->pdf_file);
            }

            if (isset($data['video_file'])) {
                $videoFilename = uniqid() . '-' . time() . '.' . $data['video_file']->extension();
                $data['video_file']->storeAs('public/course/chapter/video', $videoFilename);

                // Delete the old file
                Storage::delete('public/course/chapter/video/' . $courseChapter->video_file);
            }

            $courseChapter->update([
                'title'       => $data['title'],
                'description' => $data['description'],
                'pdf_file'    => $pdfFilename,
                'video_file'  => $videoFilename,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            // Delete the uploaded files
            if (isset($pdfFilename)) {
                Storage::delete('public/course/chapter/pdf/' . $pdfFilename);
            }

            if (isset($videoFilename)) {
                Storage::delete('public/course/chapter/video/' . $videoFilename);
            }

            dd($th->getMessage());
            throw $th;
        }
    }

    public function destroy($id)
    {
        return $this->courseChapter->find($id)->update([
            'is_active' => false
        ]);
    }

    public function restore($id)
    {
        return $this->courseChapter->find($id)->update([
            'is_active' => true
        ]);
    }

    public function getPage($id, $page)
    {
        return $this->courseChapter->with(['quiz'])->where('course_id', $id)->paginate($page);
    }

    public function isCompleted($id)
    {
        $courseChapter = $this->courseChapter->find($id);
        $isComplete = UserCourseAccessLog::where('course_id', $courseChapter->course_id)
            ->where('user_id', auth()->user()->id)
            ->where('course_chapter_id', $id)
            ->first() ? true : false;
        return $isComplete;
    }
}
