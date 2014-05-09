<?php

namespace UPS\Entity;


class DimensionalWeight {
    /**
     * @var UnitOfMeasurement
     */
    public $UnitOfMeasurement;

    public $Weight;

    function __construct() {
        $this->UnitOfMeasurement = new UnitOfMeasurement();
    }

} 