<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        try {
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->extension();

            $file->storeAs('public/institution', $fileName);

            User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'gender' => $request->gender,
                'birthday' => date('Y-m-d', strtotime($request->birthday)),
                'avatar' => null,
                'file' => $fileName,
                'phone' => $request->phone,
                'job' => $request->job,
                'institution' => $request->institution,
                'role' => User::ROLE_INSTITUTION,
                'status' => User::STATUS_PENDING,
                'is_verificator' => null
            ]);

            return redirect()->back()->with('success', 'Pendaftaran berhasil, silahkan menunggu verifikasi dari admin');
        } catch (\Throwable $th) {
            // delete file
            Storage::delete('public/institution/' . $fileName);
            return redirect()->back()->with('error', 'Pendaftaran gagal, silahkan coba lagi');
        }
    }
    public function downloadTemplate()
    {
        $templatePath = public_path('template surat/Template_Surat_Pernyataan.pdf');
        $templateName = 'Template_Surat_Pernyataan.pdf';

        return response()->download($templatePath, $templateName);
    }
}