<?php

namespace App\Utils\RR;

use App\Exceptions\RequestException;

class CURLHelper{
    public $headers = "";
    private $cookiePath;

    /**
     * CURLHelper constructor.
     * @param string $cookiePath
     */
    public function __construct($cookiePath = null){
        $this->cookiePath = $cookiePath;
    }

    public function handleHeaderLine($curl, $header_line){
        $this->headers .= $header_line;
        return strlen($header_line);
    }

    /**
     * @param $url
     * @param null $headers
     * @param int $followLocation
     * @param null $cookieJar
     * @param null $cookieFile
     * @param null $referer
     * @return mixed
     * @throws RequestException
     */
    public function get(
        $url, &$headers = null, $followLocation = 0, $cookieJar = null, $cookieFile = null, $referer = null
    ) : string{
        return $this->sendRequest(\curl_init(), $url, $headers, $followLocation, $cookieJar, $cookieFile, $referer);
    }

    /**
     * @param $url
     * @param array $values
     * @param &$headers
     * @param int $followLocation
     * @param string $cookieJar
     * @param string $cookieFile
     * @param null $referer
     * @return string
     * @throws RequestException
     */
    public function post(
        $url, array $values, &$headers = null, $followLocation = 0, $cookieJar = null, $cookieFile = null, $referer = null
    ) : string{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $values);
        return $this->sendRequest($ch, $url, $headers, $followLocation, $cookieJar, $cookieFile, $referer);
    }

    /**
     * @param $ch
     * @param $url
     * @param null $headers
     * @param int $followLocation
     * @param null $cookieJar
     * @param null $cookieFile
     * @param null $referer
     * @return mixed
     * @throws RequestException
     */
    private function sendRequest(
        $ch, $url, &$headers = null, $followLocation = 0, $cookieJar = null, $cookieFile = null, $referer = null
    ) : string{
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0');
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, array(&$this, "handleHeaderLine"));

        if ($followLocation)
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if (isset($cookieJar))
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
        if (isset($cookieFile))
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        else if(isset($this->cookiePath))
            curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiePath);

        curl_setopt($ch, CURLOPT_REFERER, isset($referer) ? $referer : 'http://rivalregions.com/');

        $body = curl_exec($ch);
        curl_close($ch);

        $headers = $this->headers;

        $responseCode = explode(" ",
            HTMLParseHelper::cut(substr($headers, strripos($headers, "HTTP/")), "\n"))[1];
        if($responseCode == 200){
            $this->headers = "";
            return $body;
        } else
            throw new RequestException($headers, $responseCode);
    }

    public static function milliseconds(){
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }
}