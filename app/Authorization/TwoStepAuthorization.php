<?php

namespace App\Authorization;


use App\Exceptions\AuthorizationException;
use GuzzleHttp\Cookie\CookieJar;

abstract class TwoStepAuthorization extends AuthorizationHelper {
    abstract protected function authSocial(): void;

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
}