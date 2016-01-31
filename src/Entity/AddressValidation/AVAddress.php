<?php namespace Ups\Entity\AddressValidation;

class AVAddress
{
    public $addressClassification;
    public $consigneeName;
    public $buildingName;
    public $addressLine;
    public $region;
    public $politicalDivision2;
    public $politicalDivision1;
    public $postcodePrimaryLow;
    public $postcodeExtendedLow;
    public $urbanization;
    public $countryCode;

    /**
     * Address constructor.
     * @param \SimpleXMLElement $xmlDoc
     */
    public function __construct(\SimpleXMLElement $xmlDoc)
    {
        if ($xmlDoc->count() == 0) {
            throw new \InvalidArgumentException(__METHOD__ . ': The passed object does not have any child nodes.');
        }
        $this->addressClassification = isset($xmlDoc->AddressClassification) ? new AddressClassification($xmlDoc->AddressClassification) : null;
        $this->consigneeName = isset($xmlDoc->ConsigneeName) ? (string)$xmlDoc->ConsigneeName : '';
        $this->buildingName = isset($xmlDoc->BuildingName) ? (string)$xmlDoc->BuildingName : '';
        $this->addressLine = isset($xmlDoc->AddressLine) ? (string)$xmlDoc->AddressLine : '';
        $this->region = isset($xmlDoc->Region) ? (string)$xmlDoc->Regions : '';
        $this->politicalDivision2 = isset($xmlDoc->PoliticalDivision2) ? (string)$xmlDoc->PoliticalDivision2 : '';
        $this->politicalDivision1 = isset($xmlDoc->PoliticalDivision1) ? (string)$xmlDoc->PoliticalDivision1 : '';
        $this->postcodePrimaryLow = isset($xmlDoc->PostcodePrimaryLow) ? (string)$xmlDoc->PostcodePrimaryLow : '';
        $this->postcodeExtendedLow = isset($xmlDoc->PostcodeExtendedLow) ? (string)$xmlDoc->PostcodeExtendedLow : '';
        $this->urbanization = isset($xmlDoc->Urbanization) ? (string)$xmlDoc->Urbanization : '';
        $this->consigneeName = isset($xmlDoc->CountryCode) ? (string)$xmlDoc->CountryCode : '';
    }

    /**
     * Convenience methods. Even though all properties are public, these methods provide a convenient interface to
     * retrieve commonly requested parts so that the user doesn't have to remember which API fields reference
     * which piece of information. For example, I won't have to remember that the city is in 'PoliticalDivision2'.
     */

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->politicalDivision2;
    }

    /**
     * @return string
     */
    public function getStateProvince()
    {
        return $this->politicalDivision1;
    }

    /**
     * @param bool $withExtended
     * @param string $extendedDivider
     * @return string
     */
    public function getPostalCode($withExtended = false, $extendedDivider = '-')
    {
        if ($withExtended) {
            return $this->postcodePrimaryLow . $extendedDivider . $this->postcodeExtendedLow;
        }
        return $this->postcodePrimaryLow;
    }
}