<?php

namespace Ups\Entity;

class ServiceSummary
{
    use ServiceSummaryTrait;

    /** @deprecated */
    public $EstimatedArrival;

    /** @var  \Ups\Entity\EstimatedArrival */
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
     * @return \Ups\Entity\EstimatedArrival
     */
    public function getEstimatedArrival()
    {
        return $this->estimatedArrival;
    }

    /**
     * @param \Ups\Entity\EstimatedArrival
     */
    public function setEstimatedArrival(EstimatedArrival $estimatedArrival)
    {
        $this->EstimatedArrival = $estimatedArrival;
        $this->estimatedArrival = $estimatedArrival;
    }
}
