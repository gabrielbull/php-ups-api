<?php

namespace UPS\Entity;


class ShipmentWeight {
    /**
     * @var UnitOfMeasurement
     */
    public $UnitOfMeasurement;

    public $Weight;

    function __construct() {
        $this->UnitOfMeasurement = new UnitOfMeasurement();
    }

} 