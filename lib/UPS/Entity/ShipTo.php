<?php
namespace Ups\Entity;

class ShipTo
{
    public $LocationID;
    public $ReceivingAddressName;
    public $Bookmark;
    public $ShipperAssignedIdentificationNumber;
    public $CompanyName;
    public $AttentionName;
    public $PhoneNumber;
    public $TaxIdentificationNumber;
    public $FaxNumber;
    public $EMailAddress;
    public $Address;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->LocationID)) {
                $this->LocationID = $response->LocationID;
            }
            if (isset($response->ReceivingAddressName)) {
                $this->ReceivingAddressName = $response->ReceivingAddressName;
            }
            if (isset($response->Bookmark)) {
                $this->Bookmark = $response->Bookmark;
            }
            if (isset($response->ShipperAssignedIdentificationNumber)) {
                $this->ShipperAssignedIdentificationNumber = $response->ShipperAssignedIdentificationNumber;
            }
            if (isset($response->CompanyName)) {
                $this->CompanyName = $response->CompanyName;
            }
            if (isset($response->AttentionName)) {
                $this->AttentionName = $response->AttentionName;
            }
            if (isset($response->PhoneNumber)) {
                $this->PhoneNumber = $response->PhoneNumber;
            }
            if (isset($response->TaxIdentificationNumber)) {
                $this->TaxIdentificationNumber = $response->TaxIdentificationNumber;
            }
            if (isset($response->FaxNumber)) {
                $this->FaxNumber = $response->FaxNumber;
            }
            if (isset($response->EMailAddress)) {
                $this->EMailAddress = $response->EMailAddress;
            }
            if (isset($response->Address)) {
                $this->Address = new Address($response->Address);
            }
        }
    }
} 