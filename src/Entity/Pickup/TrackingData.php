<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class TrackingData implements NodeInterface
{
    /**
     * @var string
     */
    private $trackingNumber;

    public function __construct(string $trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
    }

    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('TrackingData');

        $node->appendChild($document->createElement('TrackingNumber', $this->getTrackingNumber()));

        return $node;
    }
}
