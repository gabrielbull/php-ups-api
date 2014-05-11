<?php
namespace Ups\Entity;

class PackageServiceOptions
{
    public $COD;
    public $InsuredValue;
    public $EarliestDeliveryTime;
    public $HazardousMaterialsCode;
    public $HoldForPickup;


    function __construct($response = null)
    {
        $this->COD = new COD();

        if (null != $response) {
            if (isset($response->COD)) {
                $this->COD = new COD($response->COD);
            }
            if (isset($response->InsuredValue)) {
                $this->InsuredValue = new InsuredValue($response->InsuredValue);
            }
            if (isset($response->EarliestDeliveryTime)) {
                $this->EarliestDeliveryTime = $response->EarliestDeliveryTime;
            }
            if (isset($response->HazardousMaterialsCode)) {
                $this->HazardousMaterialsCode = $response->HazardousMaterialsCode;
            }
            if (isset($response->HoldForPickup)) {
                $this->HoldForPickup = $response->HoldForPickup;
            }
        }
    }
}