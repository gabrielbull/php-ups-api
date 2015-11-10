<?php

namespace Ups\Entity;

class COD
{

    public $CODCode;
    public $CODAmount;

    public function __construct($response = null)
    {
        $this->CODAmount = new CODAmount();

        if (null != $response) {
            if (isset($response->CODCode)) {
                $this->CODCode = $response->CODCode;
            }
            if (isset($response->CODAmount)) {
                $this->CODAmount = new CODAmount($response->CODAmount);
            }
        }
    }
}
