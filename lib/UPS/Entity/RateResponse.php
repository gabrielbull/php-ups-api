<?php

namespace UPS\Entity;


class RateResponse {
    public $Service;
    public $RateShipmentWarning;
    public $BillingWeight;
    public $TransportationCharges;
    public $ServiceOptionsCharges;
    public $TotalCharges;
    public $GuaranteedDaysToDelivery;
    public $ScheduledDeliveryTime;
    public $RatedPackage;

    function __construct( $response = null ) {
        $this->Service = new Service();
        $this->BillingWeight = new BillingWeight();
        $this->TransportationCharges = new Charges();
        $this->ServiceOptionsCharges = new Charges();
        $this->TotalCharges = new Charges();

        if ( null != $response ) {
            if ( isset( $response->Service ) ) {
                $this->Service->Code = $response->Service->Code;
            }
            if ( isset( $response->RatedShipmentWarning ) ) {
                $this->RateShipmentWarning = $response->RatedShipmentWarning;
            }
            if ( isset( $response->BillingWeight ) ) {
                $this->BillingWeight->Weight = $response->BillingWeight->Weight;
                $this->BillingWeight->UnitOfMeasurement->Code = $response->BillingWeight->UnitOfMeasurement->Code;
            }
            if ( isset( $response->TransportationCharges ) ) {
                $this->TransportationCharges->CurrencyCode = $response->TransportationCharges->CurrencyCode;
                $this->TransportationCharges->MonetaryValue = $response->TransportationCharges->MonetaryValue;
            }
            if ( isset( $response->ServiceOptionsCharges ) ) {
                $this->ServiceOptionsCharges->CurrencyCode = $response->ServiceOptionsCharges->CurrencyCode;
                $this->ServiceOptionsCharges->MonetaryValue = $response->ServiceOptionsCharges->MonetaryValue;
            }
            if ( isset( $response->TotalCharges ) ) {
                $this->TotalCharges->CurrencyCode = $response->TotalCharges->CurrencyCode;
                $this->TotalCharges->MonetaryValue = $response->TotalCharges->MonetaryValue;
            }

        }

    }

    public function getServiceName() {
        return $this->Service->getName();
    }
}