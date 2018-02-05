<?php

namespace Ups\Entity;

use LogicException;

class ItemizedPaymentInformation
{

    /**
     * @var splitDutyVATIndicator
     */
    private $splitDutyVATIndicator;
    private $transportationShipmentCharge = null;
    private $dutiesAndTaxesShipmentCharge = null;

    public function __construct($attributes = null)
    {
    }

    /**
     * @return transportationShipmentCharge
     */
    public function getTransportationShipmentCharge()
    {
        return $this->transportationShipmentCharge;
    }

    /**
     * @param ShipmentCharge $shipmentCharge
     * @return ItemizedPaymentInformation
     */
    public function setShipmentCharge(ShipmentCharge $shipmentCharge)
    {
        if ($shipmentCharge->getType() == ShipmentCharge::SHIPMENT_CHARGE_TYPE_TRANSPORTATION) {
           $this->transportationShipmentCharge = $shipmentCharge;
        } else if ($shipmentCharge->getType() == ShipmentCharge::SHIPMENT_CHARGE_TYPE_DUTIES) {
            $this->dutiesAndTaxesShipmentCharge = $shipmentCharge;
        } else {
            throw new LogicException(sprintf('Unknown ShipmentCharge charge type requested: "%s"', $type));
        }
        return $this;
    }

    /**
     * @return dutiesAndTaxesShipmentCharge
     */
    public function getDutiesAndTaxesShipmentCharge()
    {
        return $this->dutiesAndTaxesShipmentCharge;
    }

    /**
     * @return splitDutyVATIndicator
     */
    public function getSplitDutyVATIndicator()
    {
        return $this->splitDutyVATIndicator;
    }

    /**
     * @param splitDutyVATIndicator $splitDutyVATIndicator
     * @return ItemizedPaymentInformation
     */
    public function setSplitDutyVATIndicator($splitDutyVATIndicator)
    {
        $this->splitDutyVATIndicator = $splitDutyVATIndicator;

        return $this;
    }
}
