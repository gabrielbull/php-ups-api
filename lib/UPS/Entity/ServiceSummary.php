<?php

namespace UPS\Entity;


class ServiceSummary {
    public $Service;
    public $Guaranteed;
    public $EstimatedArrival;
    public $SaturdayDelivery;
    public $SaturdayDeliveryDisclaimer;

    function __construct() {
        $this->Service = new Service();
        $this->Guaranteed = new Guaranteed();
        $this->EstimatedArrival = new EstimatedArrival();
    }

}