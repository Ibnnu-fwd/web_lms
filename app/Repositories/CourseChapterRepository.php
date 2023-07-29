<?php

namespace App\Repositories;

use App\Interfaces\CourseChapterInterface;
use App\Models\Course\Course;
use App\Models\Course\CourseChapter;
use Illuminate\Support\Facades\DB;

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
        return $this->courseChapter->with('courseSubChapters')->where('course_id', $courseId)->get();
    }

    public function getById($id)
    {
        return $this->courseChapter->with('course')->find($id);
    }

    public function store($data, $courseId)
    {
        return $this->courseChapter->create([
            'course_id'   => $courseId,
            'title'       => $data['title'],
            'description' => $data['description']
        ]);
    }

    public function update($data, $id)
    {
        return $this->courseChapter->find($id)->update([
            'title'       => $data['title'],
            'description' => $data['description']
        ]);
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
