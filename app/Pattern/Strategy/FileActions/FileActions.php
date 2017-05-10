<?php

namespace App\Pattern\Strategy\FileActions;

use Illuminate\Http\Request;

abstract class FileActions
{

    private $path;
    private $fileActionsStrategy;
    private $request;
    protected $fileInputName;
    protected $inputName;

    public function __construct($path, FileActionsStrategy $strategy, Request $request = null)
    {
        $this->path = $path;
        $this->fileActionsStrategy = $strategy;
        $this->request = $request;
    }

    /**
     * Upload file by FileActionsStrategy
     */
    public function upload()
    {
        $this->fileActionsStrategy->upload($this);
    }

    /**
     * Delete file by FileActionsStrategy
     */
    public function delete()
    {
        $this->fileActionsStrategy->delete($this);
    }

    /**
     * Get the path to upload file
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @return Request
     */
    public function getRequest() : Request
    {
        return $this->request;
    }

    /**
     *  <input name = "inputName" value = "fileNameToSave" type = "text">
     * @return string
     */
    public function getFileNameToSave() : string
    {
        return $this->request->input($this->inputName);
    }


    /**
     * fileInputName = img or audio, etc...
     * <lf-ng-md-file-input lf-files = "fileInputName" >
     * @return string
     */
    public function getFileInputName() : string
    {
        return $this->fileInputName;
    }

    /**
     * name = imgName or audioName
     * <input name = "inputName" type = "text">
     * @return string
     */
    public function getInputName() : string
    {
        return $this->inputName;
    }
}