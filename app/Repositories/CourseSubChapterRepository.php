<?php

namespace App\Repositories;

use App\Interfaces\CourseSubChapterInterface;
use App\Models\Course\CourseSubChapter;

class CourseSubChapterRepository implements CourseSubChapterInterface
{
    private $courseSubChapter;

    public function __construct(CourseSubChapter $courseSubChapter)
    {
        $this->courseSubChapter = $courseSubChapter;
    }

    public function store($courseChapterId, $data)
    {
        if (isset($data['file'])) {
            $fileFilename = uniqid() . '.' . $data['file']->getClientOriginalExtension();
            $data['file']->storeAs('public/course_sub_chapter', $fileFilename);
            $data['file'] = $fileFilename ?? null;
        }

        if (isset($data['video'])) {
            $fileFilename = uniqid() . '.' . $data['video']->getClientOriginalExtension();
            $data['video']->storeAs('public/course_sub_chapter', $fileFilename);
            $data['video'] = $fileFilename ?? null;
        }

        return $this->courseSubChapter->create([
            'course_chapter_id' => $courseChapterId,
            'title'             => $data['title'],
            'file'              => isset($data['file']) ? $data['file'] : null,
            'video'             => isset($data['video']) ? $data['video'] : null,
        ]);
    }
}
