<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class TrackingDataWithReferenceNumber implements NodeInterface
{
    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var null|string
     */
    private $referenceNumber;

    public function __construct(string $trackingNumber, ?string $referenceNumber)
    {
        $this->trackingNumber = $trackingNumber;
        $this->referenceNumber = $referenceNumber;
    }

    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('TrackingDataWithReferenceNumber');

        $node->appendChild($document->createElement('TrackingNumber', $this->getTrackingNumber()));

        if ($this->getReferenceNumber()) {
            $node->appendChild($document->createElement('ReferenceNumber', $this->getReferenceNumber()));
        }

        return $node;
    }
}
