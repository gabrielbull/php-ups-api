<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use DOMNode;
use Ups\NodeInterface;

class SearchFilter implements NodeInterface
{
    /**
     * @var bool
     */
    private $dcrIndicator;

    /**
     * @var bool
     */
    private $shippingAvailabilityIndicator;

    /**
     * @var int
     */
    private $shipperPreparationDelay;

    /**
     * @var string
     */
    private $clickAndCollectSortWithDistance;

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMNode
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }
        /** @var DOMElement $node */
        $node = $document->createElement('SearchFilter');

        if ($this->getDcrIndicator()) {
            $node->appendChild($document->createElement('DCRIndicator'));
        }

        if ($this->getShippingAvailabilityIndicator()) {
            $node->appendChild($document->createElement('ShippingAvailabilityIndicator'));
        }


        if ($this->getShipperPreparationDelay()) {
            $node->appendChild($document->createElement('ShipperPreparationDelay', strval($this->getShipperPreparationDelay())));
        }


        if ($this->getClickAndCollectSortWithDistance()) {
            $node->appendChild($document->createElement('ClickAndCollectSortWithDistance', strval($this->getClickAndCollectSortWithDistance())));
        }

        return $node;
    }

    /**
     * @return bool
     */
    public function getDcrIndicator()
    {
        return $this->dcrIndicator;
    }

    /**
     * @param bool $dcrIndicator
     */
    public function setDcrIndicator($dcrIndicator)
    {
        $this->dcrIndicator = $dcrIndicator;
    }

    /**
     * @return bool
     */
    public function getShippingAvailabilityIndicator()
    {
        return $this->shippingAvailabilityIndicator;
    }

    /**
     * @param bool $shippingAvailabilityIndicator
     */
    public function setShippingAvailabilityIndicator($shippingAvailabilityIndicator)
    {
        $this->shippingAvailabilityIndicator = $shippingAvailabilityIndicator;
    }

    /**
     * @return int
     */
    public function getShipperPreparationDelay()
    {
        return $this->shipperPreparationDelay;
    }

    /**
     * @param int $shipperPreparationDelay
     */
    public function setShipperPreparationDelay($shipperPreparationDelay)
    {
        $this->shipperPreparationDelay = $shipperPreparationDelay;
    }

    /**
     * @return string
     */
    public function getClickAndCollectSortWithDistance()
    {
        return $this->clickAndCollectSortWithDistance;
    }

    /**
     * @param string $clickAndCollectSortWithDistance
     */
    public function setClickAndCollectSortWithDistance($clickAndCollectSortWithDistance)
    {
        $this->clickAndCollectSortWithDistance = $clickAndCollectSortWithDistance;
    }
}