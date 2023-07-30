<?php

namespace App\Repositories;

use App\Interfaces\CourseSubChapterInterface;
use App\Models\Course\CourseSubChapter;
use Illuminate\Support\Facades\Storage;

class CourseSubChapterRepository implements CourseSubChapterInterface
{
    private $courseSubChapter;

    public function __construct(CourseSubChapter $courseSubChapter)
    {
        $this->courseSubChapter = $courseSubChapter;
    }

    public function getAll($courseChapterId)
    {
        return $this->courseSubChapter->where('course_chapter_id', $courseChapterId)->get();
    }

    public function getById($id)
    {
        return $this->courseSubChapter->with('courseChapter')->findOrFail($id);
    }

    public function store($courseChapterId, $data)
    {
        if ($data['file'] != 'undefined') {
            $fileFilename = uniqid() . '.' . $data['file']->extension();
            $data['file']->storeAs('public/course_sub_chapter', $fileFilename);
            $data['file'] = $fileFilename ?? null;
        }

        if ($data['video'] != 'undefined') {
            $fileFilename = uniqid() . '.' . $data['video']->extension();
            $data['video']->storeAs('public/course_sub_chapter', $fileFilename);
            $data['video'] = $fileFilename ?? null;
        }

        return $this->courseSubChapter->create([
            'course_chapter_id' => $courseChapterId,
            'title'             => $data['title'],
            'file'              => $data['file'] != 'undefined' ? $data['file'] : null,
            'video'             => $data['video'] != 'undefined' ? $data['video'] : null,
        ]);
    }

    public function update($courseChapterId, $id, $data)
    {
        $courseSubChapter = $this->courseSubChapter->findOrFail($id);

        if ($data['file'] != 'undefined') {
            // dd($data['file']);
            Storage::delete('public/course_sub_chapter/' . $courseSubChapter->file);
            $fileFilename = uniqid() . '.' . $data['file']->extension();
            $data['file']->storeAs('public/course_sub_chapter', $fileFilename);
            $courseSubChapter->file = $fileFilename ?? null;
        }

        if ($data['video'] != 'undefined') {
            dd($data['video']);
            Storage::delete('public/course_sub_chapter/' . $courseSubChapter->video);
            $fileFilename = uniqid() . '.' . $data['video']->extension();
            $data['video']->storeAs('public/course_sub_chapter', $fileFilename);
            $courseSubChapter->video = $fileFilename ?? null;
        }

        $courseSubChapter->course_chapter_id = $courseChapterId;
        $courseSubChapter->title             = $data['title'];
        $courseSubChapter->save();

        return $courseSubChapter;
    }

    public function deleteFile($id)
    {
        $courseSubChapter = $this->courseSubChapter->findOrFail($id);

        Storage::delete('public/course_sub_chapter/' . $courseSubChapter->file);

        $courseSubChapter->file = null;
        $courseSubChapter->save();

        return $courseSubChapter;
    }

    public function deleteVideo($id)
    {
        $courseSubChapter = $this->courseSubChapter->findOrFail($id);

        Storage::delete('public/course_sub_chapter/' . $courseSubChapter->video);

        $courseSubChapter->video = null;
        $courseSubChapter->save();

        return $courseSubChapter;
    }
}
