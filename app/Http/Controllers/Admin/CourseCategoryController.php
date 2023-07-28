<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CourseCategoryInterface;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    private $courseCategory;

    public function __construct(CourseCategoryInterface $courseCategory)
    {
        $this->courseCategory = $courseCategory;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->courseCategory->getAll())
                ->addColumn('icon', function ($data) {
                    return view('admin.course_category.column.icon', compact('data'));
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.course_category.index');
    }

    public function create()
    {
        return view('admin.course_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ], [
            'icon.required' => 'Icon harus diisi',
            'name.required' => 'Nama harus diisi',
        ]);

        try {
            $this->courseCategory->store($request->all());
            return redirect()->route('admin.course-category.index')->with('success', 'Kategori kursus berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kategori kursus gagal ditambahkan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
