<?php

namespace Ups\Entity;

class LocatorRequest
{
    /**
     * @var OriginAddress
     */
    private $originAddress;

    /**
     * @var Translate
     */
    private $translate;

    /**
     * @var LocationSearchCriteria|null
     */
    private $locationSearchCriteria;

    /**
     * @var UnitOfMeasurement|null
     */
    private $unitOfMeasurement;

    public function __construct()
    {
        $this->setOriginAddress(new OriginAddress());
        $this->setTranslate(new Translate());
    }

    /**
     * @return LocationSearchCriteria|null
     */
    public function getLocationSearchCriteria()
    {
        return $this->locationSearchCriteria;
    }

    /**
     * @param LocationSearchCriteria $locationSearchCriteria
     * @return LocatorRequest
     */
    public function setLocationSearchCriteria(LocationSearchCriteria $locationSearchCriteria)
    {
        $this->locationSearchCriteria = $locationSearchCriteria;

        return $this;
    }

    /**
     * @return OriginAddress
     */
    public function getOriginAddress()
    {
        return $this->originAddress;
    }

    /**
     * @param OriginAddress $originAddress
     * @return LocatorRequest
     */
    public function setOriginAddress(OriginAddress $originAddress)
    {
        $this->originAddress = $originAddress;

        return $this;
    }

    /**
     * @return Translate
     */
    public function getTranslate()
    {
        return $this->translate;
    }

    /**
     * @param Translate $translate
     * @return LocatorRequest
     */
    public function setTranslate(Translate $translate)
    {
        $this->translate = $translate;

        return $this;
    }

    /**
     * @return UnitOfMeasurement|null
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @param UnitOfMeasurement $unitOfMeasurement
     * @return LocatorRequest
     */
    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement)
    {
        $this->unitOfMeasurement = $unitOfMeasurement;

        return $this;
    }
}
