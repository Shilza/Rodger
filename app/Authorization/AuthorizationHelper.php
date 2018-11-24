<?php

namespace App\Authorization;


use App\Exceptions\AuthorizationException;
use App\Utils\DirectoryHelper;
use App\Utils\RR\CookieHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\FileCookieJar;
use GuzzleHttp\TransferStats;

abstract class AuthorizationHelper {
    const COOKIE_DIR = 'storage/app/cookies/';

    protected $guzzle;

    protected $login;
    protected $password;

    protected $referer;

    /**
     * @var FileCookieJar
     */
    protected $cookies;
    protected $cookiePath;

    /**
     * NewAuthorizationHelper constructor.
     * @param string $login
     * @param string $password
     * @param string $cookiePath
     * @param bool $force
     */
    public function __construct(string $login, string $password, bool $force = false, ?string $cookiePath = null) {
        $this->guzzle = new Client([
            'cookies' => ($this->cookies = new FileCookieJar($this->cookiePath = CookieHelper::cookiePath($cookiePath))),
            'allow_redirects' => true,
            'on_stats' => function (TransferStats $stats) {
                $this->referer = $stats->getEffectiveUri() . '';
            }
        ]);
        $this->login = $login;
        $this->password = $password;

        if ($force)
            $this->cookies->clear();
    }

    /**
     * @return CookieJar
     * @throws AuthorizationException
     */
    public function authorize(): CookieJar {
        if (!$this->checkRR()) {
            if (!$this->checkSocial()) {
                $this->authSocial();
                if(!$this->checkSocial())
                    throw new AuthorizationException('Social auth failed');
            }
            $this->authRR();
            if(!$this->checkRR())
                throw new AuthorizationException('RR auth failed');
        }
        $this->cookies->save($this->cookiePath);
        return $this->cookies;
    }

    private function checkRR(): bool {
        return
            str_contains(($this->guzzle->get('https://rivalregions.com')->getBody() . ''), 'c_html');
    }

    protected static function cookiePath(?string $fingerprint): string {
        return self::COOKIE_DIR
            . (isset($fingerprint) ? $fingerprint : DirectoryHelper::getUniqueDirectoryName(self::COOKIE_DIR));
    }

    abstract protected function checkSocial(): bool;

    abstract protected function authSocial(): void;

    abstract protected function authRR(): void;
}