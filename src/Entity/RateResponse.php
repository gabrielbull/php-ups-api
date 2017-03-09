<?php

namespace Ups\Entity;

class RateResponse
{
    /**
     * @var RatedShipment[]
     */
    public $RatedShipment;

    public function __construct($response = null)
    {
        $this->RatedShipment = [];

        if (null !== $response) {
            if (isset($response->RatedShipment)) {
                if (is_array($response->RatedShipment)) {
                    foreach ($response->RatedShipment as $ratedShipment) {
                        $this->RatedShipment[] = new RatedShipment($ratedShipment);
                    }
                } else {
                    $this->RatedShipment[] = new RatedShipment($response->RatedShipment);
                }
            }
        }
    }
}
