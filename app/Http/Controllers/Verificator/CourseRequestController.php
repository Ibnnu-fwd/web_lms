<?php

namespace App\Http\Controllers\Verificator;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseInterface;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class CourseRequestController extends Controller
{
    private $course;

    public function __construct(CourseInterface $course)
    {
        $this->course = $course;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->course->getAll())
                ->addColumn('image', function ($data) {
                    return view('verificator.course_request.column.image', compact('data'));
                })
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('category', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('chapter_count', function ($data) {
                    return $data->courseChapter->count() . ' Bab';
                })
                ->addColumn('contributor', function ($data) {
                    return $data->user->fullname;
                })
                ->addColumn('price', function ($data) {
                    return 'Rp. ' . number_format($data->price, 0, ',', '.');
                })
                ->addColumn('request_status', function ($data) {
                    return view('verificator.course_request.column.request_status', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('verificator.course_request.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('verificator.course_request.index');
    }

    public function approve($id)
    {
        $this->course->approve($id);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menyetujui permintaan pembuatan course'
        ]);
    }

    public function reject($id)
    {
        try {
            $this->course->reject($id);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menolak permintaan pembuatan course'
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function pending($id)
    {
        $this->course->pending($id);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengubah status permintaan pembuatan course menjadi menunggu'
        ]);
    }
}
