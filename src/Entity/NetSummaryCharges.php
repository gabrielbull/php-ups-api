<?php

namespace Ups\Entity;

class NetSummaryCharges
{
    /**
     * @var Charges
     */
    public $GrandTotal;

    /**
     * @var Charges|null
     */
    public $TotalChargesWithTaxes;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->GrandTotal = new Charges();

        if (null !== $response) {
            if (isset($response->GrandTotal)) {
                $this->GrandTotal = new Charges($response->GrandTotal);
            }
            if (isset($response->TotalChargesWithTaxes)) {
                $this->TotalChargesWithTaxes = new Charges($response->TotalChargesWithTaxes);
            }
        }
    }
}
