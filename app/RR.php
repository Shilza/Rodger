<?php

namespace App;


use App\Authorization\AuthorizationHelper;
use App\Service\AutoWorkService;
use App\Service\DepartmentRequestEntity;
use App\Service\DepartmentService;
use App\Service\MilitaryAcademyBuildingService;

class RR {

    private $guzzle;
    private $cookies;

    /**
     * RR constructor.
     * @param AuthorizationHelper $helper
     */
    public function __construct(AuthorizationHelper $helper) {
        $helper->authorize();
        $this->guzzle = $helper->getClient();
        $this->cookies = $helper->getCookies();
    }

    public function militaryAcademy(){
        (new MilitaryAcademyBuildingService($this->guzzle))->process();
    }

    public function autoWork(){
        (new AutoWorkService($this->guzzle))->process();
    }

    public function buildDepartments(): void {
        (new DepartmentService($this->guzzle, new DepartmentRequestEntity(['gold' => 10])))->process();
    }
}