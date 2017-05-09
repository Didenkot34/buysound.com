<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 05.05.17
 * Time: 23:52
 */

namespace App\Pattern\Strategy\FileActions;

use File;

class AudioFileActionsStrategy extends FileActionsStrategy
{

    public function upload(FileActions $fileActions)
    {
        $request = $fileActions->getRequest();
        $fileInputName = 'audio';
        $fileNameToSave = $fileActions->getFileNameToSave('audioName');
        $path = $fileActions->getPath();
        if ($fileNameToSave) {
            $request->file($fileInputName )->storeAs($path, $fileNameToSave, 'public');
        }

    }

    public function delete(FileActions $fileActions)
    {

        File::deleteDirectory($fileActions->getPath());
    }
}