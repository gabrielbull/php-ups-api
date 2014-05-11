<?php
namespace Ups\Entity;

class TimeInTransitResponse
{
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

    function __construct($response = null)
    {
        $this->TransitFrom = new Address();
        $this->TransitTo = new Address();
        $this->ShipmentWeight = new ShipmentWeight();
        $this->InvoiceLineTotal = new Charges();
        $this->ServiceSummary = array();

        if (null != $response) {
            if (isset($response->PickupDate)) {
                $this->PickupDate = $response->PickupDate;
            }
            if (isset($response->TransitFrom)) {
                $this->TransitFrom = new AddressArtifactFormat($response->TransitFrom);
            }
            if (isset($response->TransitTo)) {
                $this->TransitTo = new AddressArtifactFormat($response->TransitTo);
            }
            if (isset($response->DocumentsOnlyIndicator)) {
                $this->DocumentsOnlyIndicator = $response->DocumentsOnlyIndicator;
            }
            if (isset($response->AutoDutyCode)) {
                $this->AutoDutyCode = $response->AutoDutyCode;
            }
            if (isset($response->ShipmentWeight)) {
                $this->ShipmentWeight = new ShipmentWeight($response->ShipmentWeight);
            }
            if (isset($response->InvoiceLineTotal)) {
                $this->InvoiceLineTotal = new Charges($response->InvoiceLineTotal);
            }
            if (isset($response->Disclaimer)) {
                $this->Disclaimer = $response->Disclaimer;
            }
            if (isset($response->ServiceSummary)) {
                foreach ($response->ServiceSummary as $serviceSummary) {
                    $this->ServiceSummary[] = new ServiceSummary($serviceSummary);
                }
            }
            if (isset($response->MaximumListSize)) {
                $this->MaximumListSize = $response->MaximumListSize;
            }

        }
    }

} 