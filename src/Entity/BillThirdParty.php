<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class BillThirdParty implements NodeInterface
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

    /**
     * @param DOMDocument|null $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('BillThirdParty');

        $btpNode = $node->appendChild($document->createElement('BillThirdPartyShipper'));
        $btpNode->appendChild($document->createElement('AccountNumber', $this->getAccountNumber()));

        $tpNode = $btpNode->appendChild($document->createElement('ThirdParty'));
        $addressNode = $tpNode->appendChild($document->createElement('Address'));

        $thirdPartAddress = $this->getThirdPartyAddress();
        if (isset($thirdPartAddress) && $this->getThirdPartyAddress()->getPostalCode()) {
            $addressNode->appendChild($document->createElement('PostalCode', $this->getThirdPartyAddress()->getPostalCode()));
        }

        $addressNode->appendChild($document->createElement('CountryCode', $this->getThirdPartyAddress()->getCountryCode()));

        return $node;
    }
}
