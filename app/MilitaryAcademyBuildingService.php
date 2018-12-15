<?php

namespace App;


use App\Utils\RR\HTMLParseHelper as Parser;
use GuzzleHttp\Client;

class MilitaryAcademyBuildingService extends Service {
    private $id;

    private $accountBody;

    private $residencyRegion;

    private $region;

    private $c;


    public function __construct(Client $guzzle) {
        $this->guzzle = $guzzle;

        $this->id = $this->getId();
        $this->accountBody = $this->guzzle->get("https://rivalregions.com/slide/profile/$this->id")->getBody();

        $this->residencyRegion = $this->getResidency($this->accountBody);
        $this->region = $this->getRegion($this->accountBody);
    }

    //TODO: Laravel jobs
    public function process(): void {
        if ($this->residencyRegion !== $this->region) {
            $body = $this->guzzle->get("https://rivalregions.com/slide/profile/$this->id")->getBody();
            if($this->residencyRegion !== $this->getRegion($body)) {
                sleep($this->flying() ? $this->flyingTime() : $this->fly($this->residencyRegion));
                $this->process();
            } else
                $this->buildMilitaryAcademy();
        } else
            $this->buildMilitaryAcademy();
    }

    private function fly(string $id) {
        $response = $this->guzzle->post("http://rivalregions.com/map/region_move/$id", ['form_params' => [
            'b' => 1,
            'c' => $this->getC(),
            'type' => 2
        ]])->getBody();

        return Parser::find('/var move\t=\t(\d+)/;', $response, true)[1] / 1000;
    }

    public function buildMilitaryAcademy() {
        $this->guzzle->post('http://rivalregions.com/slide/academy_do/', ['form_params' => ['c' => $this->getC()]]);
    }

    private function getId(): string {
        return Parser::find('/var id\t+\=\t+(\d+);/',
            $this->guzzle->get('http://rivalregions.com')->getBody(), true)[1];
    }

    private function getResidency(string $body): string {
        return Parser::findAll('/map\/details\/(\d+)/', $body, true)[1][1];
    }

    private function getRegion(string $body) {
        return Parser::findAll('/map\/details\/(\d+)/', $body, true)[1][0];
    }

    private function flying(): bool {
        return preg_match('/cancel_move/',
            $this->guzzle->get('https://rivalregions.com/main/content?c=' . $this->getC())->getBody());
    }

    private function flyingTo(): ?string {
        if ($this->flying()) {
            $body = $this->guzzle->get('https://rivalregions.com/main/content?c=' . $this->getC())->getBody();
            return Parser::find('/<span action="map\/details\/(\d+)" class="dot hov2 gototravel">/',
                $body, true)[1];
        } else
            return null;
    }

    private function flyingTime() {
        return Parser::find(
                '/var\tmove\t=\t(\d+)/',
                $this->guzzle->get('http://rivalregions.com/map/region_data/' . $this->flyingTo() . '?c=' . $this->getC())->getBody(),
                true
            )[1] / 1000;
    }
}