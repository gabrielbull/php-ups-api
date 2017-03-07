<?php

namespace Ups\Entity;

use DOMDocument;

class ShipmentCharge
{
    const TYPE_TRANSPORTATION = '01';
    const TYPE_DUTY_AND_TAX   = '02';

    /**
     * @var string
     */
    private $type;

    /**
     * @var BillShipper
     */
    private $billShipper;

    /**
     * @var bool
     */
    private $consigneeBilled;

    public function __construct($attributes = null)
    {
        if ($attributes === null) {
            return $this;
        }
        if (isset($attributes->Type)) {
            $this->setType($attributes->Type);
        }
        if (isset($attributes->BillShipper)) {
            $this->setBillShipper(new BillShipper($attributes->BillShipper));
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (is_null($document)) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ShipmentCharge');

        if ($this->getType()) {
            $node->appendChild($document->createElement('Type', $this->getType()));
        }
        if ($this->getBillShipper()) {
            $node->appendChild($this->getBillShipper()->toNode($document));
        }

        return $node;
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
     *
     * @return ShipmentCharge
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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
     *
     * return ShipmentCharge
     */
    public function setBillShipper($billShipper)
    {
        $this->billShipper = $billShipper;

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
     * @return PaymentInformation
     */
    public function setConsigneeBilled($consigneeBilled)
    {
        $this->consigneeBilled = $consigneeBilled;

        return $this;
    }
}
