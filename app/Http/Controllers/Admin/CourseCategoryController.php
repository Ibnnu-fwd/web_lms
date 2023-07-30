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
                ->addColumn('action', function ($data) {
                    return view('admin.course_category.column.action', compact('data'));
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
            $this->courseCategory->create($request->all());
            return redirect()->back()->with('success', 'Kategori kursus berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kategori kursus gagal ditambahkan');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return view('admin.course_category.edit', [
            'courseCategory' => $this->courseCategory->getById($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ], [
            'icon.required' => 'Icon harus diisi',
            'name.required' => 'Nama harus diisi',
        ]);

        try {
            $this->courseCategory->update($id, $request->all());
            return redirect()->back()->with('success', 'Kategori kursus berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kategori kursus gagal diperbarui');
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->courseCategory->delete($id);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }
}
