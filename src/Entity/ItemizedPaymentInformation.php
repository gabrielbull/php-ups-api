<?php

namespace Ups\Entity;

class ItemizedPaymentInformation
{

    /**
     * Charges for Transportation (max 1) and Duties and Tax (max 1)
     *
     * @var array
     */
    private $charges = array();

    /**
     * @param ShipmentCharge $charge
     * @return $this
     */
    public function addShipmentCharge(ShipmentCharge $charge)
    {
        $this->charges[] = $charge;

        return $this;
    }

    /**
     * @return ShipmentCharge[]
     */
    public function getShipmentCharges()
    {
        return $this->charges;
    }

    /**
     * @param ShipmentCharge[] $charges
     * @return $this
     */
    public function setShipmentCharges(array $charges)
    {
        $this->charges = $charges;

        return $this;
    }

}
