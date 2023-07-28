<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Interfaces\VerificatorInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificatorController extends Controller
{
    private $verificator;
    private $user;

    public function __construct(VerificatorInterface $verificator, UserInterface $user)
    {
        $this->verificator = $verificator;
        $this->user        = $user;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->verificator->getAll())
                ->addColumn('name', function ($data) {
                    return $data->fullname;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('d M Y');
                })
                ->addColumn('action', function ($data) {
                    return view('admin.verificator.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.verificator.index');
    }

    public function create()
    {
        $verificators = $this->user->getAll()
            ->where('is_verificator', false)
            ->where('role', '!=', User::ROLE_ADMIN);

        return view('admin.verificator.create', [
            'users' => $verificators,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->verificator->store($request);
            return redirect()->back()->with('success', 'Verifikator berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Verifikator gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $verificator = $this->verificator->getById($id);
        return view('admin.verificator.edit', [
            'verificator' => $verificator,
        ]);
    }

    public function destroy($id)
    {
        $this->verificator->destroy($id);
        return response()->json(true);
    }
}
