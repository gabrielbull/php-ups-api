<?php

namespace Ups\Entity;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class FreightCollect
{
    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var Address
     */
    private $billReceiverAddress;

    /**
     * @param \stdClass|null $attributes
     */
    public function __construct(\stdClass $attributes = null)
    {
        if (isset($attributes->AccountNumber)) {
            $this->setAccountNumber($attributes->AccountNumber);
        }
        if (isset($attributes->BillReceiverAddress)) {
            $this->setBillReceiverAddress(new Address($attributes->BillReceiverAddress));
        }
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
     * @return FreightCollect
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * @return Address
     */
    public function getBillReceiverAddress()
    {
        return $this->billReceiverAddress;
    }

    /**
     * @param Address $address
     * @return FreightCollect
     */
    public function setBillReceiverAddress(Address $address = null)
    {
        $this->billReceiverAddress = $address;

        return $this;
    }
}
