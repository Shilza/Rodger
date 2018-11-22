<?php

namespace App\Authorization;


use App\Exceptions\AuthorizationException;
use App\Exceptions\MakeDirectoryException;
use App\Exceptions\RequestException;
use App\Utils\RR\HTMLParseHelper;
use App\Utils\RR\CURLHelper;

abstract class AuthorizationHelper{
    const COOKIE_PATH = 'storage/app/';

    protected $curl;
    protected $login;
    protected $password;
    protected $force;

    /**
     * @var int
     */
    public $accountID;

    /**
     * @var string
     */
    public $cookiePath;


    /**
     * AuthorizationHelper constructor.
     * @param string $login
     * @param string $password
     * @param bool $force
     */
    public function __construct(string $login, string $password, bool $force = false){
        $this->curl = new CURLHelper();
        $this->login = $login;
        $this->password = $password;
        $this->force = $force;
    }

    /**
     * @throws AuthorizationException
     * @throws MakeDirectoryException
     * @throws RequestException
     */
    public function authorize() : void {
        $arr = explode(DIRECTORY_SEPARATOR, static::class);
        $cookiePath = static::getCookieDirectory(array_pop($arr)) . "/$this->login";

        $this->deleteIfExpired($cookiePath);
        $this->logIn($cookiePath);

        $this->authorizeRR($cookiePath);
    }

    /**
     * @param string $cookiePath
     */
    abstract public function logIn(string $cookiePath) : void;

    /**
     * @param string $cookiePath
     * @throws AuthorizationException
     * @throws RequestException
     * @throws MakeDirectoryException
     */
    abstract protected function authorizeRR(string $cookiePath) : void;

    /**
     * @param $type
     * @return string
     * @throws MakeDirectoryException
     */
    protected static function getCookieDirectory(string $type = 'RR') : string{
        $path = static::COOKIE_PATH . DIRECTORY_SEPARATOR . $type;
        if(!(file_exists($path) || mkdir($path, 0777, true)))
            throw new MakeDirectoryException();

        return $path;
    }

    /**
     * @param $cookieRR
     * @return bool|int
     * @throws RequestException
     */
    protected function checkRRCookies(string $cookieRR){
        if(preg_match('/var id.+;/',
            $this->curl->get('http://rivalregions.com', $headers, 1, null, $cookieRR),
            $matches))
            return HTMLParseHelper::getNumeric($matches[0]);

        return false;
    }

    /**
     * @param string $cookiePath
     */
    protected function deleteIfExpired(string $cookiePath){
        if (file_exists($cookiePath))
            if ($this->force)
                unlink($cookiePath);
            else
                try {
                    $this->curl->get(static::COOKIE_CHECK_URL, $headers, 0,
                        null, $cookiePath);
                } catch (RequestException $exception) {
                    unlink($cookiePath);
                }
    }
}