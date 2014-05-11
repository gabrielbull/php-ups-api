<?php
namespace Ups\Entity;

class Charges
{
    public $CurrencyCode;
    public $MonetaryValue;
    public $Code;
    public $Description;
    public $SubType;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->CurrencyCode)) {
                $this->CurrencyCode = $response->CurrencyCode;
            }
            if (isset($response->MonetaryValue)) {
                $this->MonetaryValue = $response->MonetaryValue;
            }
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
            if (isset($response->Description)) {
                $this->Description = $response->Description;
            }
            if (isset($response->SubType)) {
                $this->SubType = $response->SubType;
            }
        }
    }
} 