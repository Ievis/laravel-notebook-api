<?php

namespace App\Services;

class FileService
{
    public static function save($file)
    {
        return empty($file)
            ? asset('images/image-default.png')
            : asset($file->store('images'));
    }
}
