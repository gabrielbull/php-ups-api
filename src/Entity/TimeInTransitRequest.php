<?php

namespace Ups\Entity;

use DateTime;

class TimeInTransitRequest
{
    /**
     * @var
     */
    private $transitFrom;

    /**
     * @var
     */
    private $transitTo;

    /**
     * @var
     */
    private $shipmentWeight;

    /**
     * @var
     */
    private $totalPackagesInShipment;

    /**
     * @var
     */
    private $invoiceLineTotal;

    /**
     * @var
     */
    private $pickupDate;

    /**
     * @var bool
     */
    private $documentsOnlyIndicator = false;

    public function __construct()
    {
        $this->setTransitFrom(new AddressArtifactFormat());
        $this->setTransitTo(new AddressArtifactFormat());
        $this->setShipmentWeight(new ShipmentWeight());
        $this->setInvoiceLineTotal(new InvoiceLineTotal());
        $this->setPickupDate(new DateTime());
    }

    /**
     * @return TimeInTransitRequest
     */
    public function setDocumentsOnlyIndicator()
    {
        $this->documentsOnlyIndicator = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDocumentsOnlyIndicator()
    {
        return $this->documentsOnlyIndicator;
    }

    /**
     * @param DateTime $date
     * @return TimeInTransitRequest
     */
    public function setPickupDate(DateTime $date)
    {
        $this->pickupDate = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPickupDate()
    {
        return $this->pickupDate;
    }

    /**
     * @param AddressArtifactFormat $address
     * @return TimeInTransitRequest
     */
    public function setTransitFrom(AddressArtifactFormat $address)
    {
        $this->transitFrom = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransitFrom()
    {
        return $this->transitFrom;
    }

    /**
     * @param AddressArtifactFormat $address
     * @return TimeInTransitRequest
     */
    public function setTransitTo(AddressArtifactFormat $address)
    {
        $this->transitTo = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransitTo()
    {
        return $this->transitTo;
    }

    /**
     * @param ShipmentWeight $shipmentWeight
     * @return TimeInTransitRequest
     */
    public function setShipmentWeight(ShipmentWeight $shipmentWeight)
    {
        $this->shipmentWeight = $shipmentWeight;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipmentWeight()
    {
        return $this->shipmentWeight;
    }

    /**
     * @param $amount
     * @return TimeInTransitRequest
     * @throws \Exception
     */
    public function setTotalPackagesInShipment($amount)
    {
        if (!is_int($amount) || $amount < 0) {
            throw new \Exception('Amount of packages should be integer and above 0');
        }

        $this->totalPackagesInShipment = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalPackagesInShipment()
    {
        return $this->totalPackagesInShipment;
    }

    /**
     * @param InvoiceLineTotal $invoiceLineTotal
     * @return TimeInTransitRequest
     */
    public function setInvoiceLineTotal(InvoiceLineTotal $invoiceLineTotal)
    {
        $this->invoiceLineTotal = $invoiceLineTotal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInvoiceLineTotal()
    {
        return $this->invoiceLineTotal;
    }
}
