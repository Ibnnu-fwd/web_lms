<?php

namespace App\Http\Controllers;

use App\Interfaces\MinCoursePurchaseAtRegInterface;
use App\Models\Configuration\MinCoursePurchaseAtReg;
use Illuminate\Http\Request;

class MinCoursePurchaseAtRegController extends Controller
{
    private $minCoursePurchaseAtReg;

    public function __construct(MinCoursePurchaseAtRegInterface $minCoursePurchaseAtReg)
    {
        $this->minCoursePurchaseAtReg = $minCoursePurchaseAtReg;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->minCoursePurchaseAtReg->getAll())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('value', function ($data) {
                    return $data->value;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.min-course.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.min-course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.min-course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'  => ['required', 'string', 'max:255'],
                'value' => ['required', 'numeric'],
            ],
            [
                'name.required'  => 'Nama harus diisi',
                'value.required' => 'Nilai harus diisi',
            ]
        );

        try {
            MinCoursePurchaseAtReg::create($request->all());
            return redirect()->back()->with('success', 'Minimal pembelian kursus berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Minimal pembelian kursus gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MinCoursePurchaseAtReg $minCoursePurchaseAtReg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.min-course.edit', [
            'minCourse' => $this->minCoursePurchaseAtReg->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,)
    {
        $request = request();
        $request->validate(
            [
                'name'  => ['required', 'string', 'max:255'],
                'value' => ['required', 'numeric'],
            ],
            [
                'name.required'  => 'Nama harus diisi',
                'value.required' => 'Nilai harus diisi',
            ]
        );

        try {
            $this->minCoursePurchaseAtReg->update($id, $request->all());
            return redirect()->route('admin.mincourse.index')->with('success', 'Minimal pembelian kursus berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Minimal pembelian kursus gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $this->minCoursePurchaseAtReg->delete($id);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }
}
