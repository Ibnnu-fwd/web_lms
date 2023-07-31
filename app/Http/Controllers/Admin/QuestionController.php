<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\QuestionInterface;
use App\Interfaces\QuizInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $quiz;
    private $question;

    public function __construct(QuizInterface $quiz, QuestionInterface $question)
    {
        $this->quiz     = $quiz;
        $this->question = $question;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($quizId, Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->question->getAll($quizId))
                ->addColumn('question', function ($data) {
                    return $data->question;
                })
                ->addColumn('option_a', function ($data) {
                    return $data->option_a;
                })
                ->addColumn('option_b', function ($data) {
                    return $data->option_b;
                })
                ->addColumn('option_c', function ($data) {
                    return $data->option_c ?? '-';
                })
                ->addColumn('option_d', function ($data) {
                    return $data->option_d ?? '-';
                })
                ->addColumn('answer', function ($data) {
                    return $data->answer;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.question.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.question.index', [
            'quiz' => $this->quiz->getById($quizId),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($quizId)
    {
        return view('admin.question.create', [
            'quiz' => $this->quiz->getById($quizId),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($quizId, Request $request)
    {
        $request->validate([
            'question' => ['required'],
            'option_a' => ['required'],
            'option_b' => ['required'],
            'option_c' => ['nullable'],
            'option_d' => ['nullable'],
            'answer'   => ['required'],
        ]);

        try {
            $this->question->store($quizId, $request->all());
            return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Pertanyaan gagal ditambahkan');
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
    public function edit($quizId, string $id)
    {
        return view('admin.question.edit', [
            'quiz'     => $this->quiz->getById($quizId),
            'question' => $this->question->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($quizId, Request $request, string $id)
    {
        $request->validate([
            'question' => ['required'],
            'option_a' => ['required'],
            'option_b' => ['required'],
            'option_c' => ['nullable'],
            'option_d' => ['nullable'],
            'answer'   => ['required'],
        ]);

        try {
            $this->question->update($id, $request->all());
            return redirect()->back()->with('success', 'Pertanyaan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Pertanyaan gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($quizId, string $id)
    {
        $this->question->destroy($id);
        return response()->json([
            'status'  => true,
            'message' => 'Pertanyaan berhasil dihapus',
        ]);
    }
}
