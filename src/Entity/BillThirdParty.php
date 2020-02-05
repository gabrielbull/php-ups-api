<?php

namespace Ups\Entity;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class BillThirdParty
{
    /**
     * @var Address
     */
    private $thirdPartyAddress;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @param \stdClass|null $attributes
     */
    public function __construct(\stdClass $attributes = null)
    {
        $this->thirdPartyAddress = new Address(isset($attributes->Address) ? $attributes->Address : null);
        $this->accountNumber = isset($attributes->AccountNumber) ? $attributes->AccountNumber : null;
    }

    /**
     * @return Address
     */
    public function getThirdPartyAddress()
    {
        return $this->thirdPartyAddress;
    }

    /**
     * @param Address $thirdPartyAddress
     * @return BillThirdParty
     */
    public function setThirdPartyAddress(Address $thirdPartyAddress = null)
    {
        $this->thirdPartyAddress = $thirdPartyAddress;

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
