<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;
use Ups\Entity\UnitOfMeasurement;

class ShipmentTotalWeight implements NodeInterface
{
    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    /**
     * @var string
     */
    private $weight;

    public function __construct($response = null)
    {
        if (null !== $response) {
            if (isset($response->unitOfMeasurement)) {
                $this->setUnitOfMeasurement(new UnitOfMeasurement($response->unitOfMeasurement));
            }
            if (isset($response->Weight)) {
                $this->setWeight($response->Weight);
            }
        }
    }

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

        $node = $document->createElement('ShipmentTotalWeight');
        if ($this->getUnitOfMeasurement()) {
            $node->appendChild($this->getUnitOfMeasurement()->toNode($document));
        }

        $node->appendChild($document->createElement('Weight', $this->getWeight()));
        
        return $node;
    }

    /**
     * @return UnitOfMeasurement
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @param UnitOfMeasurement $unitOfMeasurement
     */
    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement)
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }
    
    /**
     * @param string $weight
     */
    public function setWeight($weight)
    {
        if (!is_numeric($weight)) {
            throw new \Exception('Weight value should be a numeric value');
        }

        $this->weight = $weight;
    }
}
