<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 05.01.17
 * Time: 20:56
 */

namespace App\Traits;

use File;
use Illuminate\Http\Request;

trait ActionWithFileTraits
{

    public function upload(Request $request, $path, $fileName)
    {
        $request->file('file')->move($path, $fileName . $request->file('file')->getClientOriginalExtension());
    }

    public function createPath($type, $id)
    {
        return 'upload/img/' . $type . '/' . $id;
    }

    public function createAudioPath($id)
    {
        return 'upload/audio/' . $id;
    }
}