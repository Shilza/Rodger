<?php

namespace App\Utils;

class FileHelper
{
    public static function getUniqueFileName($path = '', $extension = '')
    {
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name;
    }
}