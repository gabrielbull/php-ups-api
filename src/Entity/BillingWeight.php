<?php

namespace Ups\Entity;

class BillingWeight
{
    /**
     * @var UnitOfMeasurement
     */
    public $UnitOfMeasurement;

    public $Weight;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->UnitOfMeasurement = new UnitOfMeasurement();

        if (null !== $response) {
            if (isset($response->UnitOfMeasurement)) {
                $this->UnitOfMeasurement = new UnitOfMeasurement($response->UnitOfMeasurement);
            }
            if (isset($response->Weight)) {
                $this->Weight = $response->Weight;
            }
        }
    }
}
