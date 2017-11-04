<?php

namespace Ups\Entity\RateTimeInTransit;

use Ups\Entity\EstimatedArrivalTrait;

class EstimatedArrival
{
    use EstimatedArrivalTrait;

    protected $businessDaysInTransit;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            self::build($response);

            if (isset($response->BusinessDaysInTransit)) {
                $this->businessDaysInTransit = $response->BusinessDaysInTransit;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getBusinessDaysInTransit()
    {
        return $this->businessDaysInTransit;
    }

    /**
     * @param mixed $BusinessDaysInTransit
     */
    public function setBusinessDaysInTransit($BusinessDaysInTransit)
    {
        $this->businessDaysInTransit = $BusinessDaysInTransit;
    }
}
