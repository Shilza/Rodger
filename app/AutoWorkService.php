<?php
/**
 * Created by PhpStorm.
 * User: Toleckk
 * Date: 15.12.2018
 * Time: 2:49
 */

namespace App;


use GuzzleHttp\Client;
use App\Utils\RR\HTMLParseHelper as Parser;

//TODO: resources
class AutoWorkService extends Service {

    public function __construct(Client $guzzle) {
        $this->guzzle = $guzzle;
    }

    public function process(): void {
        if($this->limit() !== '0.00')
            $this->setAuto();
    }

    private function limit(): string {
        $body = $this->guzzle->get('https://rivalregions.com/work?c=' . $this->getC())->getBody();
        return Parser::find(
            '/class="imp yellow tip" style="font-size: \d+px;">(.*?)</',
            $body,
            true
        )[1];
    }

    private function setAuto() {
        $this->guzzle->post('https://rivalregions.com/work/autoset/', ['form_params' => [
            'c' => $this->getC(),
            'factory' => $this->getFactory(),
            'type' => 6,
            'lim' => 0,
            'mentor' => 0
        ]]);
    }

    private function getFactory(): string {
        return Parser::find(
            '/factory: (\d+)/',
            $this->guzzle->get('https://rivalregions.com/work?c=' . $this->getC())->getBody(),
            true
        )[1];
    }

    //TODO: not implemented
    private function workOnFactory($id){}
}