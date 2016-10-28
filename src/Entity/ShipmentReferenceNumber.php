<?php

namespace Ups\Entity;

class ShipmentReferenceNumber
{
    public $Number;
    public $BarCodeIndicator;
    public $Code;
    public $Value;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->Number)) {
                $this->Number = $response->Number;
            }
            if (isset($response->BarCodeIndicator)) {
                $this->BarCodeIndicator = $response->BarCodeIndicator;
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
