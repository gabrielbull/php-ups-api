<?php
/**
 * Created by PhpStorm.
 * User: sebastienvergnes
 * Date: 29/04/14
 * Time: 18:05
 */

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