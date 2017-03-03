<?php

namespace Ups\Entity;

use DOMDocument;
use Ups\NodeInterface;

class ItemizedPaymentInformation implements NodeInterface
{

    /**
     * Charges for Transportation (max 1) and Duties and Tax (max 1)
     *
     * @var array
     */
    private $charges = array();

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ItemizedPaymentInformation');

        foreach ($this->getShipmentCharges() as $shipmentCharge) {
            $chNode = $document->createElement('ShipmentCharge');
            $chNode->appendChild($document->createElement('Type', $shipmentCharge->getType()));

            if ($shipmentCharge->getBillShipper()) {
                $chNode->appendChild($shipmentCharge->getBillShipper()->toNode($document));
            } elseif ($shipmentCharge->getBillReceiver()) {
                $receiverNode = $document->createElement('BillReceiver');

                if ($shipmentCharge->getBillReceiver()->getAccountNumber()) {
                    $receiverNode->appendChild($document->createElement('AccountNumber', $shipmentCharge->getBillReceiver()->getAccountNumber()));
                }
                if ($shipmentCharge->getBillReceiver()->getPostalCode()) {
                    $address = $document->createElement('Address');
                    $address->appendChild($document->createElement('PostalCode', $shipmentCharge->getBillReceiver()->getPostalCode()));
                    $receiverNode->appendChild($address);
                }

                $chNode->appendChild($receiverNode);
            } elseif ($shipmentCharge->getThirdPartyBilled()) {
                $chNode->appendChild($shipmentCharge->getThirdPartyBilled()->toNode($document));
            } elseif ($shipmentCharge->getConsigneeBilled()) {
                $chNode->appendChild($document->createElement('ConsigneeBilled'));
            }

            $node->appendChild($chNode);

            if ($shipmentCharge->getSplitDutyVATIndicator()) {
                $node->appendChild($document->createElement('SplitDutyVATIndicator'));
            }
        }
        
        return $node;
    }

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
