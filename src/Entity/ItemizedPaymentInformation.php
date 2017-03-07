<?php

namespace Ups\Entity;

use DOMDocument;

class ItemizedPaymentInformation
{

    /**
     * @var ShipmentCharge
     */
    private $transporation;

    /**
     * @var ShipmentCharge
     */
    private $dutyAndTax;

    /**
     * @var bool
     */
    private $splitDutyVATIndicator;

    public function __construct($attributes = null)
    {
        if (isset($attributes->ShipmentCharges)) {
            foreach ($attributes->ShipmentCharges as $shipmentCharge) {
                if (!isset($shipmentCharge->Type)) {
                    continue;
                }

                if ($shipmentCharge->Type === ShipmentCharge::TYPE_TRANSPORTATION) {
                    $this->setTransportation(new ShipmentCharge($shipmentCharge));
                } elseif ($shipmentCharge->Type === ShipmentCharge::TYPE_DUTY_AND_TAX) {
                    $this->setDutyAndTax(new ShipmentCharge($shipmentCharge));
                }
            }
        }

        if(isset($attributes->SplitDutyVATIndicator)) {
            $this->setSplitDutyVATIndicator($attributes->SplitDutyVATIndicator);
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

        $node = $document->createElement('ItemizedPaymentInformation');
        if ($this->getTransportation()) {
            $node->appendChild($this->getTransportation()->toNode($document));
        }
        if ($this->getDutyAndTax()) {
            $node->appendChild($this->getDutyAndTax()->toNode($document));
        }
        if ($this->getSplitDutyVATIndicator()) {
            $node->appendChild($document->createElement('SplitDutyVATIndicator'));
        }

        return $node;
    }

    /**
     * @return ShipmentCharge
     */
    public function getTransportation()
    {
        return $this->transportation;
    }

    /**
     * @param ShipmentCharge $transportation
     *
     * @return ItemizedPaymentInformation
     */
    public function setTransportation(ShipmentCharge $transportation)
    {
        $this->transportation = $transportation;

        return $this;
    }

    /**
     * @return ShipmentCharge
     */
    public function getDutyAndTax()
    {
        return $this->dutyAndTax;
    }

    /**
     * @param ShipmentCharge $dutyAndTax
     *
     * @return ItemizedPaymentInformation
     */
    public function setDutyAndTax(ShipmentCharge $dutyAndTax)
    {
        $this->dutyAndTax = $dutyAndTax;

        return $this;
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
     *
     * @return ItemizedPaymentInformation
     */
    public function setSplityDutyVATIndicator($splitDutyVATIndicator)
    {
        $this->splitDutyVATIndicator = $splitDutyVATIndicator;

        return $this;
    }
}
