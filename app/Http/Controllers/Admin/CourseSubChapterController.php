<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseChapterInterface;
use App\Interfaces\CourseSubChapterInterface;
use Illuminate\Http\Request;

class CourseSubChapterController extends Controller
{
    private $courseChapter;
    private $courseSubChapter;

    public function __construct(CourseChapterInterface $courseChapter, CourseSubChapterInterface $courseSubChapter)
    {
        $this->courseChapter    = $courseChapter;
        $this->courseSubChapter = $courseSubChapter;
    }

    public function index($courseChapterId, Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->courseSubChapter->getAll($courseChapterId))
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('file', function ($data) {
                    return view('admin.course_sub_chapter.column.file', compact('data'));
                })
                ->addColumn('video', function ($data) {
                    return view('admin.course_sub_chapter.column.video', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.course_sub_chapter.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
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

    public function store($courseChapterId, Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        try {
            $this->courseSubChapter->store($courseChapterId, $request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil menambahkan sub bab'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function edit($courseChapterId)
    {
        // dd($this->courseSubChapter->getById($courseChapterId));
        return view('admin.course_sub_chapter.edit', [
            'courseSubChapter' => $this->courseSubChapter->getById($courseChapterId),
        ]);
    }

    public function update($courseChapterId, $courseSubChapterId, Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        try {
            $this->courseSubChapter->update($courseChapterId, $courseSubChapterId, $request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil mengubah sub bab'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function deleteFile($courseSubChapterId)
    {
        $this->courseSubChapter->deleteFile($courseSubChapterId);
        return response()->json([
            'status'  => true,
            'message' => 'Berhasil menghapus file'
        ]);
    }

    public function deleteVideo($courseSubChapterId)
    {
        $this->courseSubChapter->deleteVideo($courseSubChapterId);
        return response()->json([
            'status'  => true,
            'message' => 'Berhasil menghapus video'
        ]);
    }
}
