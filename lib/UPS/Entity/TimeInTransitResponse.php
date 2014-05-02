<?php

namespace UPS\Entity;


class TimeInTransitResponse {
    public $PickupDate;
    public $TransitFrom;
    public $TransitTo;
    public $DocumentsOnlyIndicator;
    public $AutoDutyCode;
    public $ShipmentWeight;
    public $InvoiceLineTotal;
    public $Disclaimer;
    public $ServiceSummary;
    public $MaximumListSize;

    function __construct() {
        $this->TransitFrom = new Address();
        $this->TransitTo = new Address();
        $this->ShipmentWeight = new ShipmentWeight();
        $this->InvoiceLineTotal = new Charges();
        $this->ServiceSummary = array();
    }

} 