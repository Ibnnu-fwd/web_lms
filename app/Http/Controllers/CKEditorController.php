<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    const UPLOAD_PATH = 'public/content';

    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image     = $request->file('upload');
        $imageName = uniqid() . '.' . $image->extension();
        $image->storeAs(self::UPLOAD_PATH, $imageName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url             = asset('storage/content/' . $imageName);
        $msg             = 'Image uploaded successfully';
        $response        = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }
}
