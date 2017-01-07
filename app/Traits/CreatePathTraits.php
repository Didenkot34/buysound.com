<?php
/**
 * Created by PhpStorm.
 * User: didenko
 * Date: 05.01.17
 * Time: 20:56
 */

namespace App\Traits;


trait CreatePathTraits
{

    public function createPath($type, $id)
    {
        return 'img/' . $type . '/' . $id;
    }
}