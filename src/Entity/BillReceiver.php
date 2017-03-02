<?php

namespace Ups\Entity;

/**
 * @author Thijs Wijnmaalen <thijs@wijnmaalen.name>
 */
class BillReceiver
{
    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @param \stdClass|null $attributes
     */
    public function __construct(\stdClass $attributes = null)
    {
        $this->postalCode = isset($attributes->PostalCode) ? $attributes->PostalCode : null;
        $this->accountNumber = isset($attributes->AccountNumber) ? $attributes->AccountNumber : null;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return BillReceiver
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     * @return BillThirdParty
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }
}
