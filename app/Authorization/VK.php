<?php

namespace App\Authorization;


use App\Exceptions\AuthorizationException;
use App\Exceptions\MakeDirectoryException;
use App\Exceptions\RequestException;
use App\Utils\RR\HTMLParseHelper as Parser;

//TODO: REFACTOR
class VK extends AuthorizationHelper
{
    const OAUTH_URL =
        'https://oauth.vk.com/authorize?client_id=3524629&display=page&scope=notify,friends&redirect_uri=http://rivalregions.com/main/vklogin&response_type=code&state=';
    const COOKIE_CHECK_URL = 'https://m.vk.com/id0';
    const HEADERS_PARSING_REGEX = '/Location: .*access_token=(.+?)&.*viewer_id=(\d+)&.*auth_key=(.+\n)/';

    /**
     * @param string $cookiePath
     * @throws RequestException
     */
    public function logIn(string $cookiePath): void
    {
        if (!file_exists($cookiePath)) {
            preg_match('/https:\/\/login.vk.com.+?"/',
                $this->curl->get("https://m.vk.com", $headers, 0, $cookiePath), $matches);
            $this->curl->post(Parser::deleteAll('/"/', $matches[0]), ["email" => $this->login,
                "pass" => $this->password], $headers, 1, $cookiePath, $cookiePath);
        }
    }

    /**
     * @param string $cookiePath
     * @throws AuthorizationException
     * @throws RequestException
     * @throws MakeDirectoryException
     */
    //TODO: REFACTOR
    protected function authorizeRR(string $cookiePath): void
    {
        $id = $this->getID();
        $cookieRR = static::getCookieDirectory() . DIRECTORY_SEPARATOR . $id;
        if (file_exists($cookieRR) && ($this->force || $this->checkRRCookies($cookieRR) === false))
            unlink($cookieRR);

        if (!file_exists($cookieRR)) {
            $body =
                $this->curl->get(static::OAUTH_URL, $headers, 1, null, $cookiePath);

            if (strstr($body, 'https://login.vk.com/?act=grant_access')) {
                $this->curl->get(
                    Parser::cut(
                        substr($body, strpos($body, 'https://login.vk.com/?act=grant_access')), '"'),
                    $headers, 1, null, $cookiePath, static::OAUTH_URL);
                $parameters = $this->getParametersFromHeaders($headers);
            } else
                $parameters = $this->getParametersFromBody($body);

            $id = $parameters['id'];
            $accessToken = $parameters['accessToken'];
            $hash = $parameters['hash'];

            $this->curl->get(
                "http://rivalregions.com/?id=$id&id=$id&gl_number=ru&gl_photo=&gl_photo_medium=&gl_photo_big=&tmz_sent=3&wdt_sent=1280&register_locale=ru&stateshow=&access_token=$accessToken&hash=$hash",
                $headers, 1, $cookieRR, null,
                "http://rivalregions.com/?api_url=http://api.vk.com/api.php&access_token=$accessToken&language=0&api_id=3201433&viewer_id=$id&user_id=2018017&stateshow=&auth_key=$hash");
        }

        if (($accountID = $this->checkRRCookies($cookieRR)) !== false) {
            $this->accountID = $accountID;
            $this->cookiePath = $cookieRR;
        } else
            throw new AuthorizationException("RR authorization failed");
    }

    /**
     * @param string $body
     * @return string[]
     */
    private function getParametersFromBody(string $body): array
    {
        preg_match('/name="id" value="\d+">/', $body, $matches);
        $parameters['id'] = Parser::getNumeric($matches[0]);
        preg_match('/name="access_token".+"/', $body, $matches);
        preg_match('/value=".+"/', $matches[0], $matches);
        preg_match('/".+"/', $matches[0], $matches);
        preg_match('/[^"].+[^"]/', $matches[0], $matches);
        $parameters['accessToken'] = trim($matches[0]);
        preg_match('/name="hash".+"/', $body, $matches);
        preg_match('/value=".+"/', $matches[0], $matches);
        preg_match('/".+"/', $matches[0], $matches);
        preg_match('/[^"].+[^"]/', $matches[0], $matches);
        $parameters['hash'] = trim($matches[0]);
        return $parameters;
    }

    /**
     * @param string $headers
     * @return string[]
     */
    private function getParametersFromHeaders(string $headers): array
    {
        preg_match(static::HEADERS_PARSING_REGEX, $headers, $matches);
        return ['accessToken' => $matches[1], 'id' => $matches[2], 'hash' => trim($matches[3])];
    }

    /**
     * @return null|string|string[]
     * @throws AuthorizationException
     * @throws MakeDirectoryException
     */
    private function getID()
    {
        $cookie = file_get_contents(static::getCookieDirectory('VK')
            . DIRECTORY_SEPARATOR . $this->login);
        if(!preg_match('/\tl\t\d+/', $cookie, $matches))
            throw new AuthorizationException('VK authorization failed');

        return Parser::getNumeric($matches[0]);
    }
}