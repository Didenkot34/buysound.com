<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 09.05.17
 * Time: 17:19
 */

namespace App\Pattern\Strategy\FileActions;

use File;

class FileStrategy extends FileActionsStrategy
{
    public function upload(FileActions $fileActions)
    {
        $fileNameToSave = $fileActions->getFileNameToSave();

        if ($fileNameToSave) {
            $fileActions->getRequest()
                ->file($fileActions->getFileInputName())
                ->storeAs($fileActions->getPath(), $fileNameToSave, 'public');
        }
        
    }

    public function delete(FileActions $fileActions)
    {

        File::deleteDirectory($fileActions->getPath());
    }
}