<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class ShipmentDetails implements NodeInterface
{
    /**
     * @var bool
     */
    private $hazmatIndicator;

    /**
     * @var null|PalletInformation
     */
    private $palletInformation;

    public function __construct(?PalletInformation $palletInformation, bool $hazmatIndicator = false)
    {
        $this->hazmatIndicator = $hazmatIndicator;
        $this->palletInformation = $palletInformation;
    }

    public function isHazmatIndicator(): bool
    {
        return $this->hazmatIndicator;
    }

    public function getPalletInformation(): ?PalletInformation
    {
        return $this->palletInformation;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ShipmentDetails');

        if ($this->isHazmatIndicator()) {
            $node->appendChild($document->createElement('HazmatIndicator', ''));
        }

        if ($this->getPalletInformation()) {
            $node->appendChild($this->getPalletInformation()->toNode($document));
        }

        return $node;
    }
}
