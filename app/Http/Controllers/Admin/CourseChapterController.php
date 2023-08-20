<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseChapterInterface;
use App\Interfaces\CourseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use illuminate\Support\Str;
use ZipArchive;

class CourseChapterController extends Controller
{
    private $course;
    private $courseChapter;

    public function __construct(CourseInterface $course, CourseChapterInterface $courseChapter)
    {
        $this->course = $course;
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
                ->addColumn('pdf_file', function ($data) {
                    return view('admin.course_chapter.column.pdf_file', compact('data'));
                })
                ->addColumn('video_file', function ($data) {
                    return view('admin.course_chapter.column.video_file', compact('data'));
                })
                ->addColumn('scrom_file', function ($data) {
                    return view('admin.course_chapter.column.scrom_file', compact('data'));
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.course_chapter.column.action', compact('data'));
                })
                ->rawColumns(['pdf_file', 'video_file'])
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
            'title' => ['required'],
            'description' => ['required'],
            'pdf_file' => 'nullable',
            'video_file' => 'nullable',
            'scrom_file' => 'nullable'
        ]);

        try {
            $courseChapterData = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'pdf_file' => $request->input('pdf_file'),
                'video_file' => $request->input('video_file'),
                'scrom_file' => ''
            ];

            if ($request->hasFile('scrom_file')) {
                $scromFile = $request->file('scrom_file');
                $scromExtractedFileName = Str::random(16);
                $scromFileName = $scromExtractedFileName . '.zip';

                $destinationPath = 'course/chapter/scrom/scrom';

                $scromFile->storeAs($destinationPath, $scromFileName, 'public');

                $extractedPath = storage_path('app/public/' . $destinationPath . '_extracted/' . $scromExtractedFileName);

                $zip = new ZipArchive;
                if ($zip->open(storage_path('app/public/' . $destinationPath . '/' . $scromFileName)) === TRUE) {
                    $zip->extractTo($extractedPath);
                    $zip->close();
                }

                $courseChapterData['scrom_file'] = $scromExtractedFileName;
            }

            $this->courseChapter->store($courseChapterData, $courseId);
            return redirect()->back()->with('success', 'Berhasil menambahkan chapter baru');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan chapter baru');
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
            'course_id' => $courseId,
            'course_chapter' => $this->courseChapter->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($courseId, Request $request, string $id)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'pdf_file' => 'nullable',
            'video_file' => 'nullable',
        ]);

        try {
            $this->courseChapter->update($request->all(), $id);
            return redirect()->back()->with('success', 'Berhasil mengubah chapter');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal mengubah chapter');
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
                'status' => true,
                'message' => 'Berhasil menghapus chapter'
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function restore($courseId, string $id)
    {
        try {
            $this->courseChapter->restore($id);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus chapter'
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}