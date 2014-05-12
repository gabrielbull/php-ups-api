<?php
namespace Ups\Entity;

class PackageWeight
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