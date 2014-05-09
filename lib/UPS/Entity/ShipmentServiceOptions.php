<?php

namespace UPS\Entity;


class ShipmentServiceOptions {
    public $SaturdayPickup;
    public $SaturdayDelivery;
    public $CallTagARS;

    function __construct( $response = null ) {
        $this->CallTagARS = new CallTagARS();

        if ( null != $response ) {
            if ( isset( $response->SaturdayPickup ) ) {
                $this->SaturdayPickup = $response->SaturdayPickup;
            }
            if ( isset( $response->SaturdayDelivery ) ) {
                $this->SaturdayDelivery = $response->SaturdayDelivery;
            }
            if ( isset( $response->CallTagARS ) ) {
                $this->CallTagARS = new CallTagARS( $response->CallTagARS );
            }

        }
    }

}