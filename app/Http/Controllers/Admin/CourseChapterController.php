<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseChapterInterface;
use App\Interfaces\CourseInterface;
use Illuminate\Http\Request;

class CourseChapterController extends Controller
{
    private $course;
    private $courseChapter;

    public function __construct(CourseInterface $course, CourseChapterInterface $courseChapter)
    {
        $this->course        = $course;
        $this->courseChapter = $courseChapter;
    }

    public function index($courseId, Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->courseChapter->getAll($courseId))
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.course_chapter.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.course_chapter.index', [
            'course' => $this->course->getById($courseId),
        ]);
    }

    public function create($courseId)
    {
        return view('admin.course_chapter.create', [
            'course' => $this->course->getById($courseId),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title'       => ['required'],
            'description' => ['required'],
        ]);

        try {
            $this->courseChapter->store($request->all(), $courseId);
            return redirect()->back()->with('success', 'Berhasil menambahkan bab baru');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan bab baru');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($courseId, $id)
    {
        return view('admin.course_chapter.edit', [
            'course_id'      => $courseId,
            'course_chapter' => $this->courseChapter->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($courseId, Request $request, string $id)
    {
        $request->validate([
            'title'       => ['required'],
            'description' => ['required'],
        ]);

        try {
            $this->courseChapter->update($request->all(), $id);
            return redirect()->back()->with('success', 'Berhasil mengubah bab');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal mengubah bab');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($courseId, string $id)
    {
        try {
            $this->courseChapter->destroy($id);
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil menghapus bab'
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function restore($courseId, string $id)
    {
        try {
            $this->courseChapter->restore($id);
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil menghapus bab'
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
