<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 05.05.17
 * Time: 23:45
 */

namespace App\Pattern\Strategy\FileActions;

use File;

class ImgFileActionsStrategy extends FileActionsStrategy
{

    public function upload(FileActions $fileActions)
    {
        $request = $fileActions->getRequest();
        $fileInputName = 'img';
        $fileNameToSave = $fileActions->getFileNameToSave('imgName');
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