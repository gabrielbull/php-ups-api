<?php

namespace Ups\Entity;

class AddressExtendedInformation
{
    public $Type;
    public $Low;
    public $High;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->Type)) {
                $this->Type = $response->Type;
            }
            if (isset($response->Low)) {
                $this->Low = $response->Low;
            }
            if (isset($response->High)) {
                $this->High = $response->High;
            }
        }
    }
}
