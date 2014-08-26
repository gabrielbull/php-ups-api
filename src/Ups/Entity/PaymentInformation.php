<?php

namespace Ups\Entity;


class PaymentInformation {

    public $Prepaid;

    function __construct($type = 'prepaid', $attributes = null)
    {

        switch ($type) {
            case 'prepaid':
                $this->Prepaid = new \stdClass();
                $this->Prepaid->BillShipper = new \stdClass();
                if (isset($attributes->AccountNumber)) {
                    $this->Prepaid->BillShipper->AccountNumber = $attributes->AccountNumber;
                }

                break;
            default:
                //TODO
        }

    }
} 