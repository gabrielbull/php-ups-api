<?php

namespace UPS\Entity;


class UnitOfMeasurement {
    // PackageWeight
    const UOM_LBS = 'LBS'; // Pounds (defalut)
    const UOM_KGS = 'KGS'; // Kilograms

    // Dimensions
    const UOM_IN = 'IN'; // Inches
    const UOM_CM = 'CM'; // Centimeters

    public $Code;
    public $Description;

    function __construct( $response = null ) {
        $this->Code = self::UOM_LBS;
        $this->Description = '';

        if ( null != $response ) {
            if ( isset( $response->Code ) ) {
                $this->Code = $response->Code;
            }
            if ( isset( $response->Description ) ) {
                $this->Description = $response->Description;
            }
        }
    }
} 