<?php

namespace Ups\Entity;

use LogicException;

class ItemizedPaymentInformation
{

    /**
     * @var bool
     */
    private $splitDutyVATIndicator;

    /**
     * @var transportationShipmentCharge
     */
    private $transportationShipmentCharge;

    /**
     * @var dutiesAndTaxesShipmentCharge
     */
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
        if ($shipmentCharge->getType() === ShipmentCharge::SHIPMENT_CHARGE_TYPE_TRANSPORTATION) {
            $this->transportationShipmentCharge = $shipmentCharge;
        } elseif ($shipmentCharge->getType() === ShipmentCharge::SHIPMENT_CHARGE_TYPE_DUTIES) {
            $this->dutiesAndTaxesShipmentCharge = $shipmentCharge;
        } else {
            throw new LogicException(sprintf('Unknown ShipmentCharge charge type requested: "%s"', $type));
        }
        return $this;
    }

    /**
     * @return DutiesAndTaxesShipmentCharge
     */
    public function getDutiesAndTaxesShipmentCharge()
    {
        return $this->dutiesAndTaxesShipmentCharge;
    }

    /**
     * @return bool
     */
    public function getSplitDutyVATIndicator()
    {
        return $this->splitDutyVATIndicator;
    }

    /**
     * @param bool $splitDutyVATIndicator
     * @return ItemizedPaymentInformation
     */
    public function setSplitDutyVATIndicator($splitDutyVATIndicator)
    {
        $this->splitDutyVATIndicator = $splitDutyVATIndicator;

        return $this;
    }
}
