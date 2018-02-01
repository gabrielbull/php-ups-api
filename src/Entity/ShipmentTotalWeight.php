<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ShipmentTotalWeight implements NodeInterface
{
    private $UnitOfMeasurement;
    private $Weight;

    public function __construct($response = null)
    {
        if (null !== $response) {
            if (isset($response->UnitOfMeasurement)) {
                $this->setUnitOfMeasurement($response->UnitOfMeasurement);
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
           // $node->appendChild($document->createElement('UnitOfMeasurement', $this->getUnitOfMeasurement()));
        }

        $node->appendChild($document->createElement('Weight', $this->getWeight()));
        
        return $node;
    }

    public function getUnitOfMeasurement()
    {
        return $this->UnitOfMeasurement;
    }

    public function setUnitOfMeasurement($var)
    {
        $this->UnitOfMeasurement = $var;
    }

    public function getWeight()
    {
        return $this->Weight;
    }

    public function setWeight($var)
    {
        if (!is_numeric($var)) {
            throw new \Exception('Weight value should be a numeric value');
        }

        $this->Weight = $var;
    }
}
