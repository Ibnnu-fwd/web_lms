<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function showPdf(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048'
        ]);

        $filename = uniqid() . '-' . now()->timestamp . '.' . $request->pdf_file->extension();
        $request->pdf_file->storeAs('public/pdf', $filename);

        return response()->json([
            'message' => 'File uploaded successfully',
            'url' => asset('storage/pdf/' . $filename)
        ]);
    }
}
