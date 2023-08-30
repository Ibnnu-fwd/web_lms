<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseChapterInterface;
use App\Interfaces\CourseInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course\CourseChapter;
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
            'pdf_file' => 'nullable|mimes:pdf',
            'video_file' => 'nullable|mimes:mp4',
            'scrom_file' => 'nullable|mimes:zip',
        ]);

        try {
            $courseChapter = new CourseChapter();
            $courseChapter->course_id = $courseId;
            $courseChapter->title = $request->input('title');
            $courseChapter->description = $request->input('description');

            //Opsi Execute Scrom File
            if ($request->hasFile('scrom_file')) {
                $scromFile = $request->file('scrom_file');
                $folderName = Str::random(20);
                $extractedPath = storage_path('app/public/course/chapter/scrom/scrom_extracted/') . $folderName;
                Storage::makeDirectory('public/course/chapter/scrom/scrom_extracted/' . $folderName);

                $zip = new ZipArchive();

                try {
                    if ($zip->open($scromFile) === true) {
                        $zip->extractTo($extractedPath);
                        $zip->close();
                    } else {
                        return redirect()->back()->with('error', 'Gagal mengekstrak file SCROM');
                    }

                    $courseChapter->scrom_file = $folderName;
                } catch (PostTooLargeException $e) {
                    return response()->json(['message' => 'Ukuran file terlalu besar.'], 413);
                }
            }

            //Opsi Execute Pdf File
            if ($request->hasFile('pdf_file')) {
                $pdfFile = $request->file('pdf_file');
                $pdfFileName = Str::random(20) . '.' . $pdfFile->getClientOriginalExtension();

                Storage::putFileAs('public/course/chapter/pdf', $pdfFile, $pdfFileName);

                $courseChapter->pdf_file = $pdfFileName;
            }

            //Opsi Execute Video File
            if ($request->hasFile('video_file')) {
                $videoFile = $request->file('video_file');
                $videoFileName = Str::random(20) . '.' . $videoFile->getClientOriginalExtension();

                Storage::putFileAs('public/course/chapter/video/', $videoFile, $videoFileName);

                $courseChapter->video_file = $videoFileName;
            }

            $courseChapter->save();

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