<?php
namespace Ups\Entity;

use DOMElement;
use Ups\NodeInterface;

class PackageWeight implements NodeInterface
{
    /** @deprecated */
    public $UnitOfMeasurement;

    /** @deprecated */
    public $Weight;

    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    /**
     * @var string
     */
    private $weight;

    public function __construct()
    {
        $this->setUnitOfMeasurement(new UnitOfMeasurement);
    }

    /**
     * @return DOMElement
     */
    public function toNode()
    {
        $node = new DOMElement('PackageWeight');
        $node->appendChild(new DOMElement('Weight', $this->getWeight()));
        $node->appendChild(new DOMElement('Code', $this->getUnitOfMeasurement()->getCode()));
        $node->appendChild(new DOMElement('Description', $this->getUnitOfMeasurement()->getDescription()));
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
     * @return $this
     */
    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement)
    {
        $this->UnitOfMeasurement = $unitOfMeasurement;
        $this->unitOfMeasurement = $unitOfMeasurement;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->Weight = $weight;
        $this->weight = $weight;
        return $this;
    }
}