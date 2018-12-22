<?php

namespace App\Service;


use App\Utils\RR\HTMLParseHelper as Parser;
use GuzzleHttp\Client;

class DepartmentService extends Service {
    const URL = 'http://rivalregions.com/rival/instwork';

    private $entity;

    public function __construct(Client $guzzle, DepartmentRequestEntity $entity) {
        $this->guzzle = $guzzle;
        $this->entity = $entity;
    }

    private function currentStateId(): string {
        return Parser::find(
            '/<div action="map\/state_details\/(\d+)" class="float_left index_mig_links hov2 imp pointer">/',
            $this->guzzle->get('http://rivalregions.com/main/content?c=' . $this->getC())->getBody(),
            true
        )[1];
    }

    private function departmentsOrder(string $state): array {
        return Parser::findAll('/listed\/institutes\/(\d+)/',
            $this->guzzle->get("http://rivalregions.com/map/state_details/$state?c=" . $this->getC())->getBody(),
            true
        )[1];
    }

    public function process() {
        $state = $this->currentStateId();
        $order = $this->departmentsOrder($state);
        $what = '{"state": ' . $state . ', ' . $this->entity->toString($order) . '}';
        echo "$what\n";
        echo $this->getC();
        $this->guzzle->post(static::URL, ['form_params' => [
            'c' => $this->getC(),
            'what' => $what
        ]]);
    }
}