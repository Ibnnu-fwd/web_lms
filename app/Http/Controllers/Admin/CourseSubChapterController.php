<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseChapterInterface;
use Illuminate\Http\Request;

class CourseSubChapterController extends Controller
{
    private $courseChapter;

    public function __construct(CourseChapterInterface $courseChapter)
    {
        $this->courseChapter = $courseChapter;
    }

    public function index($courseChapterId, Request $request)
    {
        return view('admin.course_sub_chapter.index', [
            'courseChapter' => $this->courseChapter->getById($courseChapterId),
        ]);
    }

    public function create($courseChapterId)
    {
        return view('admin.course_sub_chapter.create', [
            'courseChapter' => $this->courseChapter->getById($courseChapterId),
        ]);
    }
}
