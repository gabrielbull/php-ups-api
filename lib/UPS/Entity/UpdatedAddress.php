<?php
namespace Ups\Entity;

class UpdatedAddress
{
    public $AddressLine1;
    public $AddressLine2;
    public $AddressLine3;
    public $City;
    public $StateProvinceCode;
    public $PostalCode;
    public $CountryCode;
    public $PoliticalDivision1;
    public $PoliticalDivision2;
    public $PoliticalDivision3;
    public $PostcodePrimaryLow;
    public $PostcodePrimaryHigh;
    public $PostcodeExtendedLow;
    public $ResidentialAddressIndicator;
    public $ConsigneeName;
    public $StreetNumberLow;
    public $StreetPrefix;
    public $StreetName;
    public $StreetType;
    public $StreetSuffix;
    public $BuildingName;
    public $AddressExtendedInformation;

    function __construct($response = null)
    {
        $this->AddressExtendedInformation = array();

        if (null != $response) {

            if (isset($response->AddressLine1)) {
                $this->AddressLine1 = $response->AddressLine1;
            }
            if (isset($response->AddressLine2)) {
                $this->AddressLine2 = $response->AddressLine2;
            }
            if (isset($response->AddressLine3)) {
                $this->AddressLine3 = $response->AddressLine3;
            }
            if (isset($response->City)) {
                $this->City = $response->City;
            }
            if (isset($response->StateProvinceCode)) {
                $this->StateProvinceCode = $response->StateProvinceCode;
            }
            if (isset($response->PostalCode)) {
                $this->PostalCode = $response->PostalCode;
            }
            if (isset($response->CountryCode)) {
                $this->CountryCode = $response->CountryCode;
            }
            if (isset($response->PoliticalDivision1)) {
                $this->PoliticalDivision1 = $response->PoliticalDivision1;
            }
            if (isset($response->PoliticalDivision2)) {
                $this->PoliticalDivision2 = $response->PoliticalDivision2;
            }
            if (isset($response->PoliticalDivision3)) {
                $this->PoliticalDivision3 = $response->PoliticalDivision3;
            }
            if (isset($response->PostcodePrimaryLow)) {
                $this->PostcodePrimaryLow = $response->PostcodePrimaryLow;
            }
            if (isset($response->PostcodePrimaryHigh)) {
                $this->PostcodePrimaryHigh = $response->PostcodePrimaryHigh;
            }
            if (isset($response->PostcodeExtendedLow)) {
                $this->PostcodeextendedLow = $response->PostcodeExtendedLow;
            }
            if (isset($response->ResidentialAddressIndicator)) {
                $this->ResidentialAddressIndicator = $response->ResidentialAddressIndicator;
            }
            if (isset($response->ConsigneeName)) {
                $this->ConsigneeName = $response->ConsigneeName;
            }
            if (isset($response->StreetNumberLow)) {
                $this->StreetNumberLow = $response->StreetNumberLow;
            }
            if (isset($response->StreetPrefix)) {
                $this->StreetPrefix = $response->StreetPrefix;
            }
            if (isset($response->StreetName)) {
                $this->StreetName = $response->StreetName;
            }
            if (isset($response->StreetType)) {
                $this->StreetType = $response->StreetType;
            }
            if (isset($response->StreetSuffix)) {
                $this->StreetSuffix = $response->StreetSuffix;
            }
            if (isset($response->BuildingName)) {
                $this->BuildingName = $response->BuildingName;
            }
            if (isset($response->AddressExtendedInformation)) {
                foreach ($response->AddressExtendedInformation as $AddressExtendedInformation) {
                    $this->AddressExtendedInformation[] = new AddressExtendedInformation($AddressExtendedInformation);
                }
            }

        }
    }
} 