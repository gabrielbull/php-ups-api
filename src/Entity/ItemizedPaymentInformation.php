<?php

namespace Ups\Entity;

use LogicException;

class ItemizedPaymentInformation
{

    /**
     * @var bool
     */
    private $splitDutyVATIndicator;

    private $transportationShipmentCharge;

    private $dutiesAndTaxesShipmentCharge;

    public function __construct($transportationShipmentCharge = null, $dutiesAndTaxesShipmentCharge = null, $splitDutyVATIndicator = null)
    {
        if ($transportationShipmentCharge) {
            $this->setShipmentCharge($transportationShipmentCharge);
        }
        if ($dutiesAndTaxesShipmentCharge) {
            $this->setShipmentCharge($dutiesAndTaxesShipmentCharge);
        }
        if ($splitDutyVATIndicator) {
            $this->setSplitDutyVATIndicator($splitDutyVATIndicator);
        }
    }

    /**
     * @return mixed
     */
    public function getTransportationShipmentCharge()
    {
        return $this->transportationShipmentCharge;
    }

    public function setShipmentCharge(ShipmentCharge $shipmentCharge): self
    {
        if ($shipmentCharge->getType() === ShipmentCharge::SHIPMENT_CHARGE_TYPE_TRANSPORTATION) {
            $this->transportationShipmentCharge = $shipmentCharge;
        } elseif ($shipmentCharge->getType() === ShipmentCharge::SHIPMENT_CHARGE_TYPE_DUTIES) {
            $this->dutiesAndTaxesShipmentCharge = $shipmentCharge;
        } else {
            throw new LogicException(sprintf('Unknown ShipmentCharge charge type requested: "%s"', $shipmentCharge->getType()));
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDutiesAndTaxesShipmentCharge()
    {
        return $this->dutiesAndTaxesShipmentCharge;
    }

    public function getSplitDutyVATIndicator(): bool
    {
        return $this->splitDutyVATIndicator;
    }

    public function setSplitDutyVATIndicator(bool $splitDutyVATIndicator): self
    {
        $this->splitDutyVATIndicator = $splitDutyVATIndicator;

        return $this;
    }
}
