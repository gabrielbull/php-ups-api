<?php
namespace Ups\Entity;

class ReferenceNumber
{
    public $Number;
    public $Code;
    public $Value;
    public $BarCodeIndicator;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->BarCodeIndicator)) {
                $this->BarCodeIndicator = $response->BarCodeIndicator;
            }
            if (isset($response->Number)) {
                $this->Number = $response->Number;
            }
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
            if (isset($response->Value)) {
                $this->Value = $response->Value;
            }
        }
    }
} 