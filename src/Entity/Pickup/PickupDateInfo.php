<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use DOMNode;
use Ups\NodeInterface;

class PickupDateInfo implements NodeInterface
{
    /**
     * @var string Format "Hi"
     */
    private $closeTime;

    /**
     * @var string Format "Hi"
     */
    private $readyTime;

    /**
     * @var string Format "Ymd"
     */
    private $pickupDate;

    public function __construct(string $closeTime, string $readyTime, string $pickupDate)
    {
        $this->closeTime = $closeTime;
        $this->readyTime = $readyTime;
        $this->pickupDate = $pickupDate;
    }

    public function getCloseTime(): string
    {
        return $this->closeTime;
    }

    public function getReadyTime(): string
    {
        return $this->readyTime;
    }

    public function getPickupDate(): string
    {
        return $this->pickupDate;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PickupDateInfo');

        $node->appendChild($document->createElement('CloseTime', $this->getCloseTime()));
        $node->appendChild($document->createElement('ReadyTime', $this->getReadyTime()));
        $node->appendChild($document->createElement('PickupDate', $this->getPickupDate()));

        return $node;
    }
}
