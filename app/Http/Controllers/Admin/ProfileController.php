<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    const AVATAR_PATH = 'public/avatar/';

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

    public function changeImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => ['required', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'avatar.required' => 'Foto harus diisi',
            'avatar.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg',
            'avatar.max' => 'Foto maksimal berukuran 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        try {
            $user      = User::find(auth()->user()->id);
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs(self::AVATAR_PATH, $imageName);

            if ($user->avatar) {
                Storage::delete(self::AVATAR_PATH . $user->avatar);
            }

            $user->update(['avatar' => $imageName]);

            return response()->json([
                'status'  => true,
                'message' => 'Foto berhasil diupdate',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
