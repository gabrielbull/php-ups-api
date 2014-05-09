<?php

namespace UPS\Entity;


class Shipper {
    public $Name;
    public $AttentionName;
    public $TaxIdentificationNumber;
    public $PhoneNumber;
    public $FaxNumber;
    public $ShipperNumber;
    public $EMailAddress;

    /**
     * @var Address
     */
    public $Address;

    function __construct( $response = null ) {
        if ( null != $response ) {
            if ( isset( $response->Name ) ) {
                $this->Name = $response->Name;
            }
            if ( isset( $response->AttentionName ) ) {
                $this->AttentionName = $response->AttentionName;
            }
            if ( isset( $response->TaxIdentificationNumber ) ) {
                $this->TaxIdentificationNumber = $response->TaxIdentificationNumber;
            }
            if ( isset( $response->PhoneNumber ) ) {
                $this->PhoneNumber = $response->PhoneNumber;
            }
            if ( isset( $response->FaxNumber ) ) {
                $this->FaxNumber = $response->FaxNumber;
            }
            if ( isset( $response->ShipperNumber ) ) {
                $this->ShipperNumber = $response->ShipperNumber;
            }
            if ( isset( $response->EMailAddress ) ) {
                $this->EMailAddress = $response->EMailAddress;
            }
            if ( isset( $response->Address ) ) {
                $this->Address = new Address($response->Address);
            }
        }
    }

} 