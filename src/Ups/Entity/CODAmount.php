<?php

namespace Ups\Entity;

class CODAmount
{
    public $CurrencyCode;
    public $MonetaryValue;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->CurrencyCode)) {
                $this->CurrencyCode = $response->CurrencyCode;
            }
            if (isset($response->MonetaryValue)) {
                $this->MonetaryValue = $response->MonetaryValue;
            }
        }
    }
}
