<?php

namespace Ups\Entity;

use DOMDocument;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class BillShipper
{
    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var CreditCard
     */
    private $creditCard;

    /**
     * @param \stdClass|null $attributes
     */
    public function __construct(\stdClass $attributes = null)
    {
        if (isset($attributes->AccountNumber)) {
            $this->setAccountNumber($attributes->AccountNumber);
        }
        if (isset($attributes->CreditCard)) {
            $this->setAccountNumber(new CreditCard($attributes->CreditCard));
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (is_null($document)) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('BillShipper');
        if ($this->getAccountNumber()) {
            $node->appendChild($document->createElement('AccountNumber', $this->getAccountNumber()));
        }

        return $node;
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
     *
     * @return BillShipper
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * @return CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard $creditCard
     * @return BillShipper
     */
    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;

        return $this;
    }
}
