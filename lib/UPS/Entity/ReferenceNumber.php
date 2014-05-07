<?php

namespace UPS\Entity;


class ReferenceNumber {
    public $Value;

    function __construct( $response = null ) {
        if ( null != $response ) {
            if ( isset( $response->Value ) ) {
                $this->Value = $response->Value;
            }
        }
    }
} 