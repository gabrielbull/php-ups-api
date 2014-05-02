<?php

namespace UPS\Entity;


class PackageWeight {
    /**
     * @var UnitOfMeasurement
     */
    public $UnitOfMeasurement;

    public $Weight;

    function __construct() {
        $this->UnitOfMeasurement = new UnitOfMeasurement();
    }

} 