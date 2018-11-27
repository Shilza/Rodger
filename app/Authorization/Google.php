<?php

namespace App\Authorization;


use App\Exceptions\AuthorizationException;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\FileCookieJar;
use GuzzleHttp\TransferStats;

class Google extends AuthorizationHelper {
    protected function checkSocial(): bool {
        return !str_contains($this->guzzle->get('https://myaccount.google.com/')->getBody(),
            'https://accounts.google.com/SignUp');
    }

    protected function authRR(): void {
        $cookies = exec('casperjs ' . __DIR__ . "/google.js $this->login $this->password",$output);

        file_put_contents($this->cookiePath, $cookies);

        $this->guzzle = new Client([
            'cookies' => ($this->cookies = new FileCookieJar($this->cookiePath)),
            'allow_redirects' => true,
            'headers' => ['User-Agent' => static::AGENT],
            'on_stats' => function (TransferStats $stats) {
                $this->referer = $stats->getEffectiveUri() . '';
            }
        ]);
    }

    /**
     * @return CookieJar
     * @throws AuthorizationException
     */
    public function authorize(): CookieJar {
        if(!$this->checkRR())
            $this->authRR();

        if(!$this->checkRR())
            throw new AuthorizationException('RR auth failed');

        $this->cookies->save($this->cookiePath);
        return $this->cookies;
    }
}