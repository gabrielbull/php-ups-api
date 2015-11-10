<?php

namespace Ups\Entity\Tradeability;

class LandedCostRequest
{

    /**
     * @var QueryRequest
     */
    private $queryRequest;

    /**
     * @var EstimateRequest
     */
    private $estimateRequest;

    /**
     * @return QueryRequest
     */
    public function getQueryRequest()
    {
        return $this->queryRequest;
    }

    /**
     * @param QueryRequest $queryRequest
     * @return LandedCostRequest
     */
    public function setQueryRequest($queryRequest)
    {
        $this->queryRequest = $queryRequest;

        return $this;
    }

    /**
     * @return EstimateRequest
     */
    public function getEstimateRequest()
    {
        return $this->estimateRequest;
    }

    /**
     * @param EstimateRequest $estimateRequest
     * @return LandedCostRequest
     */
    public function setEstimateRequest($estimateRequest)
    {
        $this->estimateRequest = $estimateRequest;

        return $this;
    }
}
