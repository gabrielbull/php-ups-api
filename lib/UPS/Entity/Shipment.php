<?php
namespace Ups\Entity;

class Shipment
{
    public $Description;

    /**
     * @var Shipper
     */
    public $Shipper;

    /**
     * @var Shipper;
     */
    public $ShipTo;

    /**
     * @var Shipper
     */
    public $ShipFrom;

    /**
     * @var Service
     */
    public $Service;

    /**
     * @var array
     */
    public $Package;

    public $ShipmentServiceOptions;

    function __construct()
    {
        $this->Package = array();
    }
} 