<?php
namespace Ups\Entity;

class CustomsValue
{
    public $MonetaryValue;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->MonetaryValue)) {
                $this->MonetaryValue = $response->MonetaryValue;
            }
        }
    }
} 