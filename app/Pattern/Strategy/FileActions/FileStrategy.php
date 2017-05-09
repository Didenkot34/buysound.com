<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 09.05.17
 * Time: 17:19
 */

namespace App\Pattern\Strategy\FileActions;
use File;

class FileStrategy extends  FileActionsStrategy
{
    public function upload(FileActions $fileActions)
    {
        $request = $fileActions->getRequest();
        $fileInputName = $fileActions->getFileInputName();
        $inputName = $fileActions->getInputName();
        $fileNameToSave = $fileActions->getFileNameToSave($inputName);
        $path = $fileActions->getPath();
        
        if ($fileNameToSave) {
            $request->file($fileInputName)->storeAs($path, $fileNameToSave, 'public');
        }


    }

    public function delete(FileActions $fileActions)
    {

        File::deleteDirectory($fileActions->getPath());
    }
}