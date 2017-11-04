<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * @author mazzarito
 */
class DeliveryTimeInformation implements NodeInterface
{
    const PBT_DOCUMENT_ONLY = '02';
    const PBT_NON_DOCUMENT = '03';
    const PBT_PALLET = '04';

    /*
     * @var string
     */
    private $packageBillType;

    /*
     * @var Pickup
     */
    private $pickup;

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

        $node = $document->createElement('DeliveryTimeInformation');
        $node->appendChild($document->createElement('PackageBillType', $this->getPackageBillType()));

        if ($this->getPickup() !== null) {
            $node->appendChild($this->getPickup()->toNode($document));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getPackageBillType()
    {
        return $this->packageBillType;
    }

    /**
     * @param string $packageBillType
     */
    public function setPackageBillType($packageBillType)
    {
        $this->packageBillType = $packageBillType;
    }

    /**
     * @return Pickup
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param Pickup $pickup
     */
    public function setPickup($pickup)
    {
        $this->pickup = $pickup;
    }
}
