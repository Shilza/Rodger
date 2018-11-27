<?php

namespace App\Authorization;
use App\Utils\RR\HTMLParseHelper as Parser;

class VK extends TwoStepAuthorization {
    const OAUTH_URL = 'https://oauth.vk.com/authorize?client_id=3524629&display=page&scope=notify,friends&redirect_uri=http://rivalregions.com/main/vklogin&response_type=code&state=';

    protected function authSocial(): void {
        $link = Parser::find('/https:\/\/login.vk.com.+?"/', $this->guzzle->get("https://m.vk.com")->getBody());
        $this->guzzle->post(Parser::deleteAll('/"/', $link),
            ['form_params' => ["email" => $this->login, "pass" => $this->password]]);
    }

    protected function authRR(): void {
        $body = $this->guzzle->get(self::OAUTH_URL)->getBody();
        if(str_contains($body, 'https://login.vk.com/?act=grant_access')){
            $this->guzzle->get(
                Parser::find('/(https:\/\/login.vk.com\/\?act=grant_access.*?)"/', $body, true)[1],
                ['curl' => [CURLOPT_REFERER => static::OAUTH_URL]]
            );
            $params = $this->parseParamsFromReferer();
        } else
            $params = $this->parseParamsFromBody($body);

        $this->guzzle->get(
            "http://rivalregions.com/?id=$params[0]&id=$params[0]&gl_number=ru&gl_photo=&gl_photo_medium=&gl_photo_big=&tmz_sent=3&wdt_sent=1280&register_locale=ru&stateshow=&access_token=$params[1]&hash=$params[2]",
            ['curl' => [CURLOPT_REFERER => "http://rivalregions.com/?api_url=http://api.vk.com/api.php&access_token=$params[1]&language=0&api_id=3201433&viewer_id=$params[0]&user_id=2018017&stateshow=&auth_key=$params[2]"]]);
    }

    private function parseParamsFromReferer(): array{
        return [
            Parser::find('/viewer_id=(\d+)/', $this->referer, true)[1],
            Parser::find('/access_token=(.+?)&/', $this->referer, true)[1],
            Parser::find('/auth_key=(.+?)$/', $this->referer, true)[1]
        ];
    }

    private function parseParamsFromBody(string $body): array{
        return [
            Parser::find('/name="id" value="(\d+)"/', $body, true)[1],
            Parser::find('/name="access_token" value="(.*?)"/', $body, true)[1],
            Parser::find('/name="hash" value="(.*?)"/', $body, true)[1]
        ];
    }

    protected function checkSocial(): bool {
        return !is_null(Parser::find('/https:\/\/login\.vk\.com\/\?act=logout_mobile/',
            $this->guzzle->get('https://m.vk.com/id0')->getBody() . ''));
    }
}