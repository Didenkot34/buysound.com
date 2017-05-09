<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 05.05.17
 * Time: 23:27
 */

namespace App\Pattern\Strategy\FileActions;


abstract class FileActionsStrategy
{

    abstract public function upload(FileActions $fileActions);
    abstract public function delete(FileActions $fileActions);
}