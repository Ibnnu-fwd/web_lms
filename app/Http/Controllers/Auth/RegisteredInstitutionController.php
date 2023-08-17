<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisteredInstitutionController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registeredInstitution(Request $request)
    {
        // Validasi data yang diterima dari permintaan
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'gender' => 'required|in:L,P',
            'birthday' => 'required|date',
            'phone' => 'required',
            'job' => 'required',
            'institution' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName(); // Mendapatkan nama asli file
        $filePath = 'images/registerAuth/' . $fileName; // Path relatif dari direktori public

        // Buat data user baru
        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->job = $request->job;
        $user->institution = $request->institution;
        $user->file = $fileName;
        $user->role = 2; // Atur role sesuai kebutuhan (contoh: 2 untuk institusi)
        $user->status = 1; // Atur status sesuai kebutuhan
        $user->save();

        $storagePath = public_path('images/registerAuth');
        $file->move($storagePath, $fileName);
        return response()->json(['status' => true, 'message' => 'Registrasi berhasil!']);

    }
}