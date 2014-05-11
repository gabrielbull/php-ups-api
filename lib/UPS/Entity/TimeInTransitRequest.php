<?php
namespace Ups\Entity;

class TimeInTransitRequest
{
    public $TransitFrom;
    public $TransitTo;
    public $ShipmentWeight;
    public $TotalPackagesInShipment;
    public $InvoiceLineTotal;
    public $PickupDate;
    public $DocumentsOnlyIndicator;

    function __construct()
    {
        $this->TransitFrom = new Address();
        $this->TransitTo = new Address();
        $this->ShipmentWeight = new ShipmentWeight();
        $this->InvoiceLineTotal = new Charges();
    }

} 