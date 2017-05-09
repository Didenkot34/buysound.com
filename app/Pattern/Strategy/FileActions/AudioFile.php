<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 09.05.17
 * Time: 23:35
 */

namespace App\Pattern\Strategy\FileActions;


class AudioFile extends FileActions
{
    protected $fileInputName = 'audio';
    protected $inputName = 'audioName';
}