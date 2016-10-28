<?php

namespace Ups\Entity;

class NegotiatedRates
{
    /**
     * @var NetSummaryCharges
     */
    public $NetSummaryCharges;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->NetSummaryCharges = new NetSummaryCharges();

        if (null !== $response) {
            if (isset($response->NetSummaryCharges)) {
                $this->NetSummaryCharges = new NetSummaryCharges($response->NetSummaryCharges);
            }
        }
    }
}
