<?php

namespace Ups\Entity;

class ShipmentCharge
{
    const SHIPMENT_CHARGE_TYPE_TRANSPORTATION = '01';
    const SHIPMENT_CHARGE_TYPE_DUTIES = '02';

    const TYPE_BILL_SHIPPER = 'billShipper';
    const TYPE_BILL_RECEIVER = 'billReceiver';
    const TYPE_BILL_THIRD_PARTY = 'billThirdParty';
    const TYPE_CONSIGNEE_BILLED = 'consigneeBilled';

    /**
     * @var string
     */
    private $type;

    /**
     * @var BillShipper
     */
    private $billShipper;

    /**
     * @var BillReceiver
     * TODO not implemented yet
     */
    private $billReceiver;

    /**
     * @var BillThirdParty
     */
    private $billThirdParty;

    /**
     * @var bool
     */
    private $consigneeBilled;

    public function __construct($attributes = null)
    {
        if (isset($attributes->Type)) {
            $this->setType($attributes->Type);
        }
        if (isset($attributes->billShipper)) {
            $this->setBillShipper($attributes->billShipper);
        }
    }

    /**
     * @return BillShipper
     */
    public function getBillShipper()
    {
        return $this->billShipper;
    }

    /**
     * @param BillShipper $billShipper
     * @return ShipmentCharge
     */
    public function setBillShipper(BillShipper $billShipper)
    {
        $this->billShipper = $billShipper;

        return $this;
    }

    /**
     * @return BillReceiver
     */
    public function getBillReceiver()
    {
        return $this->billReceiver;
    }

    /**
     * @param BillReceiver $billReceiver
     * @return ShipmentCharge
     */
    public function setBillReceiver(BillReceiver $billReceiver= null)
    {
        $this->billReceiver = $billReceiver;

        return $this;
    }

    /**
     * @return BillThirdParty
     */
    public function getBillThirdParty()
    {
        return $this->billThirdParty;
    }

    /**
     * @param BillThirdParty $billThirdParty
     * @return ShipmentCharge
     */
    public function setBillThirdParty(BillThirdParty $billThirdParty = null)
    {
        $this->billThirdParty = $billThirdParty;

        return $this;
    }

    /**
     * @return bool
     */
    public function getConsigneeBilled()
    {
        return $this->consigneeBilled;
    }

    /**
     * @param bool $consigneeBilled
     * @return ShipmentCharge
     */
    public function setConsigneeBilled($consigneeBilled)
    {
        $this->consigneeBilled = $consigneeBilled;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ShipmentCharge
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
