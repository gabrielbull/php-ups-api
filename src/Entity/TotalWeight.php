<?php

namespace Ups\Entity;

use DOMDocument;
use DOMNode;
use Ups\NodeInterface;
use Ups\ValueObject\UnitOfMeasurement;

class TotalWeight implements NodeInterface
{
    /**
     * @var string
     */
    private $weight;

    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    public function __construct(string $weight, UnitOfMeasurement $unitOfMeasurement)
    {
        $this->weight = $weight;
        $this->unitOfMeasurement = $unitOfMeasurement;
    }

    public function getUnitOfMeasurement(): UnitOfMeasurement
    {
        return $this->unitOfMeasurement;
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('TotalWeight');

        $node->appendChild($document->createElement('Weight', $this->getWeight()));
        $node->appendChild($document->createElement('UnitOfMeasurement', $this->getUnitOfMeasurement()->get()));

        return $node;
    }
}
