<?php

namespace App\Repositories;

use App\Interfaces\CourseChapterInterface;
use App\Models\Course\Course;
use App\Models\Course\CourseChapter;
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
        return $this->courseChapter->with('course')->find($id);
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
}
