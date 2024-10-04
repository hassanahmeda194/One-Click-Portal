<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function downloadFile($filePath)
    {
        $full_filePath = public_path($filePath);
        if (file_exists($full_filePath)) {
            return response()->file($full_filePath);
        }
//        abort(404, 'File not found');
        return $full_filePath;
    }
}
