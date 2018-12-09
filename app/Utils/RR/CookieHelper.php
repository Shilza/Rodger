<?php

namespace App\Utils\RR;

use App\Utils\DirectoryHelper;

abstract class CookieHelper{
    const COOKIE_DIR = 'storage/app/cookies/';

    public static function cookiePath(?string $fingerprint){
        return self::COOKIE_DIR
            . (isset($fingerprint) ? $fingerprint : DirectoryHelper::getUniqueDirectoryName(self::COOKIE_DIR));
    }
}