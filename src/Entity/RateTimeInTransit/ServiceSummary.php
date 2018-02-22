<?php

namespace Ups\Entity\RateTimeInTransit;

use Ups\Entity\ServiceSummaryTrait;

class ServiceSummary
{
    use ServiceSummaryTrait;

    /**
     * @var
     */
    protected $estimatedArrival;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->build($response);

        $this->setEstimatedArrival(new EstimatedArrival());

        if (null !== $response) {
            if (isset($response->EstimatedArrival)) {
                $this->setEstimatedArrival(new EstimatedArrival($response->EstimatedArrival));
            }
        }
    }

    /**
     * @return EstimatedArrival|null
     */
    public function getEstimatedArrival()
    {
        return $this->estimatedArrival;
    }

    /**
     * @param EstimatedArrival $estimatedArrival
     */
    public function setEstimatedArrival(EstimatedArrival $estimatedArrival)
    {
        $this->estimatedArrival = $estimatedArrival;
    }
}
