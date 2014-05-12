<?php
namespace Ups\Entity;

class Shipment
{
    /** @deprecated */
    public $Description;
    /** @deprecated */
    public $Shipper;
    /** @deprecated */
    public $ShipTo;
    /** @deprecated */
    public $ShipFrom;
    /** @deprecated */
    public $Service;
    /** @deprecated */
    public $Package = array();
    /** @deprecated */
    public $ShipmentServiceOptions;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Shipper
     */
    private $shipper;

    /**
     * @var ShipTo;
     */
    private $shipTo;

    /**
     * @var ShipFrom
     */
    private $shipFrom;

    /**
     * @var Service
     */
    private $service;

    /**
     * @var Package[]
     */
    private $packages = array();

    /**
     * @var ShipmentServiceOptions
     */
    private $shipmentServiceOptions;

    public function __construct()
    {
        $this->shipper = new Shipper();
        $this->shipFrom = new ShipFrom();
        $this->shipTo = new ShipTo();
        $this->shipmentServiceOptions = new ShipmentServiceOptions();
        $this->service = new Service();
    }

    /**
     * @param Package $package
     * @return $this
     */
    public function addPackage(Package $package)
    {
        $packages = $this->getPackages();
        $packages[] = $package;
        $this->setPackages($packages);
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->Description = $description;
        $this->description = $description;
        return $this;
    }

    /**
     * @return Package[]
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * @param Package[] $packages
     * @return $this
     */
    public function setPackages(array $packages)
    {
        $this->Package = $packages;
        $this->packages = $packages;
        return $this;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     * @return $this
     */
    public function setService(Service $service)
    {
        $this->Service = $service;
        $this->service = $service;
        return $this;
    }

    /**
     * @return ShipFrom
     */
    public function getShipFrom()
    {
        return $this->shipFrom;
    }

    /**
     * @param ShipFrom $shipFrom
     * @return $this
     */
    public function setShipFrom(ShipFrom $shipFrom)
    {
        $this->ShipFrom = $shipFrom;
        $this->shipFrom = $shipFrom;
        return $this;
    }

    /**
     * @return ShipTo
     */
    public function getShipTo()
    {
        return $this->shipTo;
    }

    /**
     * @param ShipTo $shipTo
     * @return $this
     */
    public function setShipTo(ShipTo $shipTo)
    {
        $this->ShipTo = $shipTo;
        $this->shipTo = $shipTo;
        return $this;
    }

    /**
     * @return ShipmentServiceOptions
     */
    public function getShipmentServiceOptions()
    {
        return $this->shipmentServiceOptions;
    }

    /**
     * @param ShipmentServiceOptions $shipmentServiceOptions
     * @return $this
     */
    public function setShipmentServiceOptions(ShipmentServiceOptions $shipmentServiceOptions)
    {
        $this->ShipmentServiceOptions = $shipmentServiceOptions;
        $this->shipmentServiceOptions = $shipmentServiceOptions;
        return $this;
    }

    /**
     * @return Shipper
     */
    public function getShipper()
    {
        return $this->shipper;
    }

    /**
     * @param Shipper $shipper
     * @return $this
     */
    public function setShipper(Shipper $shipper)
    {
        $this->Shipper = $shipper;
        $this->shipper = $shipper;
        return $this;
    }
}