<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'fullname' => 'required|max:255',
            'gender' => 'required',
            'birthday' => 'required',
            'phone' => 'required',
            'job' => 'required',
            'institution' => 'required',
        ], [
            'fullname.required' => 'Nama harus diisi',
            'gender.required' => 'Gender harus diisi',
            'birthday.required' => 'Tanggal Lahir harus diisi',
            'phone.required' => 'No telephon harus diisi',
            'job.required' => 'Jon harus diisi',
            'institution.required' => 'Institusi harus diisi',
        ]);

        $user->update($request->all());
        if ($user == null) {
            return redirect()->back()->with('error', 'Profile gagal diupdate');
        } else {
            return redirect()->back()->with('success', 'Profile berhasil diupdate');
        }
    }
}
