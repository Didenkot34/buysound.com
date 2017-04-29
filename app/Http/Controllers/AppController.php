<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class AppController extends Controller
{

    public function uploadFile(Request $request, $path, $fileName, $type = 'file')
    {
        $request->file($type)->move($path, $fileName);
    }

    public function deleteFile($fileName)
    {
        if (File::exists($fileName)) {

            File::delete($fileName);
        }
    }

    public function deleteDirectory($directory)
    {
        File::deleteDirectory($directory);
    }
}
