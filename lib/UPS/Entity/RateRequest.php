<?php

namespace UPS\Entity;


class RateRequest {
    /**
     * @var PickupType
     */
    public $PickupType;

    /**
     * @var Shipment
     */
    public $Shipment;

    function __construct( $request = null ) {
        $this->PickupType = new PickupType();
        $this->Shipment = new Shipment();
    }

}