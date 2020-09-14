<?php

namespace Ups\Entity;

class ShipmentCharge
{
    public const SHIPMENT_CHARGE_TYPE_TRANSPORTATION = '01';
    public const SHIPMENT_CHARGE_TYPE_DUTIES = '02';

    public const TYPE_BILL_SHIPPER = 'billShipper';
    public const TYPE_BILL_RECEIVER = 'billReceiver';
    public const TYPE_BILL_THIRD_PARTY = 'billThirdParty';
    public const TYPE_CONSIGNEE_BILLED = 'consigneeBilled';

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

    public function getBillShipper(): BillShipper
    {
        return $this->billShipper;
    }

    public function setBillShipper(BillShipper $billShipper): self
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
     */
    public function setBillReceiver($billReceiver = null): self
    {
        $this->billReceiver = $billReceiver;

        return $this;
    }

    public function getBillThirdParty(): ?BillThirdParty
    {
        return $this->billThirdParty;
    }

    public function setBillThirdParty(?BillThirdParty $billThirdParty = null): self
    {
        $this->billThirdParty = $billThirdParty;

        return $this;
    }

    public function getConsigneeBilled(): bool
    {
        return $this->consigneeBilled;
    }

    public function setConsigneeBilled(bool $consigneeBilled): self
    {
        $this->consigneeBilled = $consigneeBilled;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
