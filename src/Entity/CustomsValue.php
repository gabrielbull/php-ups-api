<?php

namespace Ups\Entity;

class CustomsValue
{
    public $MonetaryValue;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->MonetaryValue)) {
                $this->MonetaryValue = $response->MonetaryValue;
            }
        }
    }
}
