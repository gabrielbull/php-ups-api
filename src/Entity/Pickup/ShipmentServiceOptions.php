<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class ShipmentServiceOptions implements NodeInterface
{
    /**
     * @var null|string
     */
    private $originLiftGateIndicator;

    /**
     * @var null|string
     */
    private $dropoffAtUPSFacilityIndicator;

    /**
     * @var null|string
     */
    private $holdForPickupIndicator;

    public function __construct(?string $originLiftGateIndicator, ?string $dropoffAtUPSFacilityIndicator, ?string $holdForPickupIndicator)
    {
        $this->originLiftGateIndicator = $originLiftGateIndicator;
        $this->dropoffAtUPSFacilityIndicator = $dropoffAtUPSFacilityIndicator;
        $this->holdForPickupIndicator = $holdForPickupIndicator;
    }

    public function getOriginLiftGateIndicator(): ?string
    {
        return $this->originLiftGateIndicator;
    }

    public function getDropoffAtUPSFacilityIndicator(): ?string
    {
        return $this->dropoffAtUPSFacilityIndicator;
    }

    public function getHoldForPickupIndicator(): ?string
    {
        return $this->holdForPickupIndicator;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ShipmentServiceOptions');

        if ($this->getOriginLiftGateIndicator()) {
            $node->appendChild($document->createElement('OriginLiftGateIndicator', $this->getOriginLiftGateIndicator()));
        }

        if ($this->getDropoffAtUPSFacilityIndicator()) {
            $node->appendChild($document->createElement('DropoffAtUPSFacilityIndicator', $this->getDropoffAtUPSFacilityIndicator()));
        }

        if ($this->getHoldForPickupIndicator()) {
            $node->appendChild($document->createElement('HoldForPickupIndicator', $this->getHoldForPickupIndicator()));
        }

        return $node;
    }
}
