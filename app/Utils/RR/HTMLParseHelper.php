<?php

namespace App\Utils\RR;


class HTMLParseHelper{

    /**
     * @param string $pattern
     * @param string $str
     * @param bool $fullResponse
     * @return string|null
     */
    public static function find(string $pattern, string $str, bool $fullResponse = false){
        if(isset($str) && isset($pattern) && preg_match($pattern, $str, $matches))
            return $fullResponse ? $matches : $matches[0];
        return null;
    }

    /**
     * @param string $pattern
     * @param string $str
     * @param bool $fullResponse
     * @return array|null
     */
    public static function findAll(string $pattern, string $str, bool $fullResponse = false){
        if(isset($str) && isset($pattern) && preg_match_all($pattern, $str, $matches))
            return $fullResponse ? $matches : $matches[0];
        return null;
    }

    /**
     * @param $str
     * @param $endSymbol
     * @return string
     */
    public static function cut($str, $endSymbol): string{
        $result = '';
        for ($i = 0; $i < strlen($str) && $str[$i] != $endSymbol; $i++)
            $result .= $str[$i];

        return $result;
    }

    public static function getNumeric($str){
        return static::deleteAll('/\D/', $str);
    }

    public static function deleteAll($pattern, $str){
        return is_null($str) ? null : preg_replace($pattern, '', $str);
    }
}