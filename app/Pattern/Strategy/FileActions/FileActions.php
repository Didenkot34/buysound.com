<?php

namespace App\Pattern\Strategy\FileActions;

use Illuminate\Http\Request;

abstract class FileActions {
    
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

    public function upload()
    {
        $this->fileActionsStrategy->upload($this);
    }

    public function delete()
    {
        $this->fileActionsStrategy->delete($this);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $inputName = 'imgName, audioName'
     * @return array|string
     */
    public function getFileNameToSave($inputName)
    {
        return $this->request->input($inputName);
    }

    public function getFileInputName()
    {
        return $this->fileInputName;
    }

    public function getInputName()
    {
        return $this->inputName;
    }
}