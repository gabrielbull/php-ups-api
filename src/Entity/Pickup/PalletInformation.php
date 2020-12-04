<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\Entity\Dimensions;
use Ups\NodeInterface;

class PalletInformation implements NodeInterface
{
    /**
     * @var Dimensions
     */
    private $dimensions;

    public function __construct(Dimensions $dimensions)
    {
        $this->dimensions = $dimensions;
    }

    public function getDimensions(): Dimensions
    {
        return $this->dimensions;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PalletInformation');
        $node->appendChild($this->getDimensions()->toNode($document));

        return $node;
    }
}
