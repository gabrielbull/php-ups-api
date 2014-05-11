<?php
namespace Ups\Entity;

class PackageWeight
{
    /**
     * @var UnitOfMeasurement
     */
    public $UnitOfMeasurement;

    public $Weight;

    function __construct()
    {
        $this->UnitOfMeasurement = new UnitOfMeasurement();
    }

} 