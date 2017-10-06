<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class DeliveryConfirmation
 * @package Ups\Entity
 */
class DeliveryConfirmation implements NodeInterface
{
    /**
     * @var
     *
     * 1 => 'Delivery Confirmation Signature Required'
     * 2 => 'Delivery Confirmation Adult Signature Required.'
     */
    private $dcisType = 1;

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

        $node = $document->createElement('DeliveryConfirmation');

        $node->appendChild($document->createElement('DCISType', $this->getDcisType()));

        return $node;
    }

    /**
     * @param mixed $SaturdayPickup
     * @return $this
     */
    public function getDcisType()
    {
        return $this->dcisType;
    }

    /**
     * @param mixed $dcisTypeId
     * @return $this
     */
    public function setDcisType($dcisTypeId)
    {
        $this->dcisType = $dcisTypeId;

        return $this;
    }

}
