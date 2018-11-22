<?php

namespace App\Utils;

class DirectoryHelper
{
    public static function getUniqueDirectoryName(string $path)
    {
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name;
        } while (file_exists($file));

        return $name;
    }
}