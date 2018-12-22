<?php

namespace App\Service;

use App\Utils\RR\HTMLParseHelper as Parser;

abstract class Service {
    protected $guzzle;

    private $c;

    public function getC(): string {
        if (is_null($this->c))
            $this->c = Parser::find(
                '/var c_html = \'(.*)\'/',
                $this->guzzle->get('http://rivalregions.com')->getBody(), true)[1];

        return $this->c;
    }
}