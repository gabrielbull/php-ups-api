<?php

namespace Ups\Entity;

use DateTime;
use Exception as BaseException;

class PickupRequest
{
    /**
     * @var
     */
    private $referenceNumber;

    /**
     * @var
     */
    private $transactionReference;

    /**
     * @var
     */
    private $accountNumber;

    /**
     * @var
     */
    private $accountCountryCode;

    /**
     * @var
     */
    private $closeTime;

    /**
     * @var
     */
    private $readyTime;

    /**
     * @var
     */
    private $pickupDate;

    /**
     * @var
     */
    private $contactName;

    /**
     * @var
     */
    private $companyName;

    /**
     * @var
     */
    private $addressLine;

    /**
     * @var
     */
    private $stateProvince;
    
    /**
     * @var
     */
    private $postalCode;

    /**
     * @var
     */
    private $countryCode;

     /**
     * @var
     */
    private $number;
    
     /**
     * @var
     */
    private $city;   

    /**
     * @var
     */
    private $packageTotalWeight;

    /**
     * @var
     */
    private $packageQuantity;

    /**
     * @var
     */
    private $destinationCountryCode;

    /**
     * @var
     */
    private $serviceCode;

    /**
     * @var
     */
    private $unitOfMeasurement;

    /**
     * @var
     */
    private $paymentMethod;

    /**
     * @var
     */
    private $specialInstruction;

    /**
     * @var
     */
    private $cancelType;

    /**
     * @var
     */
    private $prnNumber;

    /**
     * Getter for ReferenceNumber
     *
     * @return [type]
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * Setter for ReferenceNumber
     * @var [type] referenceNumber
     *
     * @return self
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
        return $this;
    }

    /**
     * Getter for TransactionReference
     *
     * @return [type]
     */
    public function getTransactionReference()
    {
        return $this->transactionReference;
    }

    /**
     * Setter for TransactionReference
     * @var [type] transactionReference
     *
     * @return self
     */
    public function setTransactionReference($transactionReference)
    {
        $this->transactionReference = $transactionReference;
        return $this;
    }

    /**
     * Getter for AccountNumber
     *
     * @return [type]
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Setter for AccountNumber
     * @var [type] accountNumber
     *
     * @return self
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * Getter for AccountCountryCode
     *
     * @return [type]
     */
    public function getAccountCountryCode()
    {
        return $this->accountCountryCode;
    }

    /**
     * Setter for AccountCountryCode
     * @var [type] accountCountryCode
     *
     * @return self
     */
    public function setAccountCountryCode($accountCountryCode)
    {
        $this->accountCountryCode = $accountCountryCode;
        return $this;
    }

        /**
     * Getter for ReadyTime
     *
     * @return [type]
     */
    public function getReadyTime()
    {
        return $this->readyTime;
    }

    /**
     * Setter for ReadyTime
     * @var [type] readyTime
     *
     * @return self
     */
    public function setReadyTime($readyTime)
    {
        $this->readyTime = $readyTime;
        return $this;
    }

    /**
     * Getter for CloseTime
     *
     * @return [type]
     */
    public function getCloseTime()
    {
        return $this->closeTime;
    }

    /**
     * Setter for CloseTime
     * @var [type] closeTime
     *
     * @return self
     */
    public function setCloseTime($closeTime)
    {
        $this->closeTime = $closeTime;
        return $this;
    }


    /**
     * Getter for PickupDate
     *
     * @return [type]
     */
    public function getPickupDate()
    {
        return $this->pickupDate;
    }

    /**
     * Setter for PickupDate
     * @var [type] pickupDate
     *
     * @return self
     */
    public function setPickupDate($pickupDate)
    {
        $this->pickupDate = $pickupDate;
        return $this;
    }

    /**
     * Getter for CompanyName
    *
    * @return [type]
    */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Setter for CompanyName
    * @var [type] companyName
    *
    * @return self
    */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * Getter for ContactName
     *
     * @return [type]
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Setter for ContactName
     * @var [type] contactName
     *
     * @return self
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
        return $this;
    }

    /**
     * Getter for AddressLine
     *
     * @return [type]
     */
    public function getAddressLine()
    {
        return $this->addressLine;
    }

    /**
     * Setter for AddressLine
     * @var [type] addressLine
     *
     * @return self
     */
    public function setAddressLine($addressLine)
    {
        $this->addressLine = $addressLine;
        return $this;
    }

    /**
     * Getter for StateProvince
     *
     * @return [type]
     */
    public function getStateProvince()
    {
        return $this->stateProvince;
    }

    /**
     * Setter for StateProvince
     * @var [type] stateProvince
     *
     * @return self
     */
    public function setStateProvince($stateProvince)
    {
        $this->stateProvince = $stateProvince;
        return $this;
    }

    /**
     * Getter for PostalCode
     *
     * @return [type]
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Setter for PostalCode
     * @var [type] postalCode
     *
     * @return self
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Getter for CountryCode
     *
     * @return [type]
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Setter for CountryCode
     * @var [type] countryCode
     *
     * @return self
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Getter for Number
    *
    * @return [type]
    */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Setter for Number
    * @var [type] number
    *
    * @return self
    */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Getter for City
     *
     * @return [type]
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Setter for City
     * @var [type] city
     *
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Getter for TotalWeight
     *
     * @return [type]
     */
    public function getPackageTotalWeight()
    {
        return $this->packageTotalWeight;
    }

    /**
     * Setter for TotalWeight
     * @var [type] totalWeight
     *
     * @return self
     */
    public function setPackageTotalWeight($packageTotalWeight)
    {
        $this->packageTotalWeight = $packageTotalWeight;
        return $this;
    }

    /**
     * Getter for Quantity
     *
     * @return [type]
     */
    public function getPackageQuantity()
    {
        return $this->packageQuantity;
    }

    /**
     * Setter for Quantity
     * @var [type] quantity
     *
     * @return self
     */
    public function setPackageQuantity($packageQuantity)
    {
        $this->packageQuantity = $packageQuantity;
        return $this;
    }

    /**
     * Getter for DestinationCountryCode
     *
     * @return [type]
     */
    public function getDestinationCountryCode()
    {
        return $this->destinationCountryCode;
    }

    /**
     * Setter for DestinationCountryCode
     * @var [type] destinationCountryCode
     *
     * @return self
     */
    public function setDestinationCountryCode($destinationCountryCode)
    {
        $this->destinationCountryCode = $destinationCountryCode;
        return $this;
    }

    /**
     * Getter for ServiceCode
     *
     * @return [type]
     */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * Setter for ServiceCode
     * @var [type] serviceCode
     *
     * @return self
     */
    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;
        return $this;
    }
    /**
     * Getter for UnitOfMeasurement
     *
     * @return [type]
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }

    /**
     * Setter for UnitOfMeasurement
     * @var [type] unitOfMeasurement
     *
     * @return self
     */
    public function setUnitOfMeasurement($unitOfMeasurement)
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
        return $this;
    }

    /**
     * Getter for PaymentMethod
     *
     * @return [type]
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Setter for PaymentMethod
     * @var [type] paymentMethod
     *
     * @return self
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * Getter for SpecialInstruction
     *
     * @return [type]
     */
    public function getSpecialInstruction()
    {
        return $this->specialInstruction;
    }

    /**
     * Setter for SpecialInstruction
     * @var [type] specialInstruction
     *
     * @return self
     */
    public function setSpecialInstruction($specialInstruction)
    {
        $this->specialInstruction = $specialInstruction;
        return $this;
    }

    /**
     * Getter for PrnNumber
     *
     * @return [type]
     */
    public function getPrnNumber()
    {
        return $this->prnNumber;
    }

    /**
     * Setter for PrnNumber
     * @var [type] prnNumber
     *
     * @return self
     */
    public function setPrnNumber($prnNumber)
    {
        $this->prnNumber = $prnNumber;
        return $this;
    }

    /**
     * Getter for cancelType
     *
     * @return [type]
     */
    public function getcancelType()
    {
        return $this->cancelType;
    }

    /**
     * Setter for cancelType
     * @var [type] cancelType
     *
     * @return self
     */

    public function setcancelType($cancelType)
    {
        $this->cancelType = $cancelType;
        return $this;
    }

}


