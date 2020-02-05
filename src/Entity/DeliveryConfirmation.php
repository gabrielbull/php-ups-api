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
     * @var int
     */
    private $dcisType;

    /**
     * DCIS type codes
     */
    const DELIVERY_CONFIRMATION_SIGNATURE_REQUIRED = 1;
    const DELIVERY_CONFIRMATION_ADULT_SIGNATURE_REQUIRED = 2;

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
     * @return int
     */
    public function getDcisType()
    {
        return $this->dcisType;
    }

    /**
     * @param int $dcisTypeId
     * @return $this
     */
    public function setDcisType($dcisTypeId)
    {
        $this->dcisType = $dcisTypeId;

        return $this;
    }
}
