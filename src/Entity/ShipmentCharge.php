<?php

namespace Ups\Entity;

/**
 * @author Thijs Wijnmaalen <thijs@wijnmaalen.name>
 */
class ShipmentCharge
{

    const TYPE_TRANSPORTATION = '01';
    const TYPE_DUTIES_AND_TAXES = '02';

    const CHARGES_BILL_SHIPPER = 'billShipper';
    const CHARGES_BILL_RECEIVER = 'billReceiver';
    const CHARGES_BILL_THIRD_PARTY = 'billThirdParty';
    const CHARGES_BILL_CONSIGNEE_BILLED = 'billConsigneeBilled';

    /**
     * @var string
     */
    private $type = '01';

    /**
     * @var BillShipper
     */
    private $billShipper;

    /**
     * @var BillReceiver
     */
    private $billReceiver;

    /**
     * @var BillThirdParty
     */
    private $billThirdParty;

    /**
     * @var boolean
     */
    private $billConsigneeBilled;

    /**
     * @var boolean
     */
    private $splitDutyVATIndicator;

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param BillShipper $shipper
     * @return $this
     */
    public function setBillShipper(BillShipper $shipper) {
        $this->billShipper = $shipper;

        return $this;
    }

    /**
     * @return BillShipper
     */
    public function getBillShipper() {
        return $this->billShipper;
    }

    /**
     * @param BillReceiver $receiver
     * @return $this
     */
    public function setBillReceiver(BillReceiver $receiver) {
        $this->billReceiver = $receiver;

        return $this;
    }

    /**
     * @return BillReceiver
     */
    public function getBillReceiver() {
        return $this->billReceiver;
    }

    /**
     * @param BillThirdParty $thirdParty
     * @return $this
     */
    public function setThirdPartyBilled(BillThirdParty $thirdParty) {
        $this->billThirdParty = $thirdParty;

        return $this;
    }

    /**
     * @return BillThirdParty
     */
    public function getThirdPartyBilled() {
        return $this->billThirdParty;
    }

    /**
     * @param boolean $bool
     * @return $this
     */
    public function setConsigneeBilled($bool = true) {
        $this->billConsigneeBilled = $bool;

        return $this;
    }

    /**
     * @return bool
     */
    public function getConsigneeBilled() {
        return $this->billConsigneeBilled;
    }

    /**
     * @param bool $indicator
     * @return $this
     */
    public function setSplitDutyVATIndicator($indicator = true) {
        $this->splitDutyVATIndicator = $indicator;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSplitDutyVATIndicator() {
        return $this->splitDutyVATIndicator;
    }

}
