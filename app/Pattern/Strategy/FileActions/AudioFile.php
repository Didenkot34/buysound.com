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
    /**
     * fileInputName = audio
     * <lf-ng-md-file-input lf-files = "fileInputName" >
     * @var string
     */
    protected $fileInputName = 'audio';

    /**
     * name = audioName
     * <input name = "inputName" type = "text">
     * @var string
     */
    protected $inputName = 'audioName';
}