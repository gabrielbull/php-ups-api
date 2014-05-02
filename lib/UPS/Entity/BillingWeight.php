<?php

namespace UPS\Entity;


class BillingWeight {
    /**
     * @var UnitOfMeasurement
     */
    public $UnitOfMeasurement;

    public $Weight;

    function __construct() {
        $this->UnitOfMeasurement = new UnitOfMeasurement();
    }
} 