<?php
namespace Ups\Entity;
use DateTime;
use Exception;

class TimeInTransitRequest
{

    private $transitFrom;
    private $transitTo;
    private $shipmentWeight;
    private $totalPackagesInShipment;
    private $invoiceLineTotal;
    private $pickupDate;
    private $documentsOnlyIndicator = false;

    function __construct()
    {
        $this->setTransitFrom(new AddressArtifactFormat);
        $this->setTransitTo(new AddressArtifactFormat);
        $this->setShipmentWeight(new ShipmentWeight);
        $this->setInvoiceLineTotal(new InvoiceLineTotal);
        $this->setPickupDate(new DateTime);
    }

    public function setDocumentsOnlyIndicator()
    {
        $this->documentsOnlyIndicator = true;
    }

    public function getDocumentsOnlyIndicator()
    {
        return $this->documentsOnlyIndicator;
    }

    public function setPickupDate(DateTime $date)
    {
        $this->pickupDate = $date;
    }

    public function getPickupDate()
    {
        return $this->pickupDate;
    }

    public function setTransitFrom(AddressArtifactFormat $address)
    {
        $this->transitFrom = $address;
    }

    public function getTransitFrom()
    {
        return $this->transitFrom;
    }

    public function setTransitTo(AddressArtifactFormat $address)
    {
        $this->transitTo = $address;
    }

    public function getTransitTo()
    {
        return $this->transitFrom;
    }

    public function setShipmentWeight(ShipmentWeight $shipmentWeight)
    {
        $this->shipmentWeight = $shipmentWeight;
    }

    public function getShipmentWeight()
    {
        return $this->shipmentWeight;
    }

    public function setTotalPackagesInShipment($amount)
    {
        if(!is_integer($amount) || $amount < 0) {
            throw new Exception('Amount of packages should be integer and above 0');
        }

        $this->totalPackagesInShipment = $amount;
    }

    public function getTotalPackagesInShipment()
    {
        return $this->totalPackagesInShipment;
    }

    public function setInvoiceLineTotal(InvoiceLineTotal $invoiceLineTotal)
    {
        $this->invoiceLineTotal = $invoiceLineTotal;
    }

    public function getInvoiceLineTotal()
    {
        return $this->invoiceLineTotal;
    }

} 