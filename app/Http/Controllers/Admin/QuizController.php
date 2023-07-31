<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseChapterInterface;
use App\Interfaces\QuizInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    private $courseChapter;
    private $quiz;

    public function __construct(CourseChapterInterface $courseChapter, QuizInterface $quiz)
    {
        $this->courseChapter = $courseChapter;
        $this->quiz          = $quiz;
    }

    public function index($courseChapterId, Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->quiz->getAll($courseChapterId))
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('question_count', function ($data) {
                    return $data->questions->count() . ' Soal';
                })
                ->addColumn('is_active', function ($data) {
                    return $data->is_active ? 'AKTIF' : 'TIDAK AKTIF';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.quiz.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.quiz.index', [
            'courseChapter' => $this->courseChapter->getById($courseChapterId)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseChapterId)
    {
        return view('admin.quiz.create', [
            'courseChapter' => $this->courseChapter->getById($courseChapterId)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($courseChapterId, Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required'
        ]);

        try {
            $this->quiz->store($courseChapterId, $request->all());
            return redirect()->back()->with('success', 'Quiz berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Quiz gagal ditambahkan');
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
    public function edit($courseChapterId, string $id)
    {
        return view('admin.quiz.edit', [
            'courseChapter' => $this->courseChapter->getById($courseChapterId),
            'quiz'          => $this->quiz->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($courseChapterId, Request $request, string $id)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required'
        ]);

        try {
            $this->quiz->update($id, $request->all());
            return redirect()->back()->with('success', 'Quiz berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Quiz gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->quiz->destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Quiz berhasil dinonaktifkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Quiz gagal dinonaktifkan'
            ]);
        }
    }

    public function restore(string $id)
    {
        try {
            $this->quiz->restore($id);
            return response()->json([
                'status' => true,
                'message' => 'Quiz berhasil diaktifkan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Quiz gagal diaktifkan'
            ]);
        }
    }
}
