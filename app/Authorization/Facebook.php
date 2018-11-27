<?php

namespace App\Authorization;

use App\Utils\RR\HTMLParseHelper as Parser;

class Facebook extends TwoStepAuthorization {
    public function authSocial(): void {
        $this->guzzle->get('https://m.facebook.com');
        $this->guzzle->post('https://m.facebook.com/login.php',
            ['form_params' => ['email' => $this->login, 'pass' => $this->password]]);
    }

    protected function authRR(): void {
        $link = Parser::find('/(https:\/\/www.facebook.com.*?)"/',
            $this->guzzle->get('http://rivalregions.com/')->getBody(), true)[1];

        $body = $this->guzzle->get($link)->getBody();

        $id = Parser::find('/name="id" value="(\d+)"/', $body, true)[1];
        $access = Parser::find('/name="access_token" value="(.*)"/', $body, true)[1];
        $hash = Parser::find('/name="hash" value="(.*)"/', $body, true)[1];

        $this->guzzle->get(
            "http://rivalregions.com/?id=$id&id=$id&gl_number=ru&gl_photo=&gl_photo_medium=&gl_photo_big=&tmz_sent=3&wdt_sent=1280&register_locale=ru&stateshow=&access_token=$access&hash=$hash",
            ['curl' => [CURLOPT_REFERER => $this->referer]]);
    }

    protected function checkSocial(): bool {
        return !str_contains($this->guzzle->get('https://m.facebook.com/home.php')->getBody() . '',
            'https://m.facebook.com/login/device-based/regular/login/');
    }
}