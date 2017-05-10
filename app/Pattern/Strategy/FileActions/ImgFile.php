<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 09.05.17
 * Time: 17:22
 */

namespace App\Pattern\Strategy\FileActions;


class ImgFile extends FileActions
{

    /**
     * fileInputName = img 
     * <lf-ng-md-file-input lf-files = "fileInputName" >
     * @var string
     */
    protected $fileInputName = 'img';

    /**
     * name = imgName
     * <input name = "inputName" type = "text">
     * @var string
     */
    protected $inputName = 'imgName';


}