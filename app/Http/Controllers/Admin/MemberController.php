<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->user->getAll())
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('fullname', function ($data) {
                    return $data->fullname;
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone ?? '-';
                })
                ->addColumn('join_date', function ($data) {
                    return date('d/m/Y', strtotime($data->created_at));
                })
                ->addColumn('status', function ($data) {
                    return strtoupper($data->status);
                })
                ->addColumn('action', function ($data) {
                    return view('member.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.member.index');
    }

    public function changeStatus(Request $request)
    {
        try {
            $this->user->changeStatus($request->id, $request->status);
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil mengubah status member'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal mengubah status member'
            ]);
        }
    }
}
