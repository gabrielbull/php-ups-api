<?php

namespace Ups\Entity\RateTimeInTransit;

use Ups\Entity\ServiceSummaryTrait;

class ServiceSummary
{
    use ServiceSummaryTrait;

    /** @var  \Ups\Entity\RateTimeInTransit\EstimatedArrival */
    protected $estimatedArrival;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        self::build($response);

        $this->setEstimatedArrival(new EstimatedArrival());

        if (null !== $response) {
            if (isset($response->EstimatedArrival)) {
                $this->setEstimatedArrival(new EstimatedArrival($response->EstimatedArrival));
            }
        }
    }

    /**
     * @return \Ups\Entity\RateTimeInTransit\EstimatedArrival
     */
    public function getEstimatedArrival()
    {
        return $this->estimatedArrival;
    }

    /**
     * @param \Ups\Entity\RateTimeInTransit\EstimatedArrival
     */
    public function setEstimatedArrival(EstimatedArrival $estimatedArrival)
    {
        $this->estimatedArrival = $estimatedArrival;
    }
}
