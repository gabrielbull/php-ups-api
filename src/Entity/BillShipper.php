<?php

namespace Ups\Entity;

use DOMDocument;
use Ups\NodeInterface;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class BillShipper implements NodeInterface
{
    const TYPE_ALTERNATE_PAYMENT_METHOD_PAYPAL = '01';

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var CreditCard
     */
    private $creditCard;

    /**
     * @var string
     */
    private $alternatePaymentMethod;

    /**
     * @param \stdClass|null $attributes
     */
    public function __construct(\stdClass $attributes = null)
    {
        if (isset($attributes->AccountNumber)) {
            $this->setAccountNumber($attributes->AccountNumber);
        }
        if (isset($attributes->CreditCard)) {
            $this->setCreditCard(new CreditCard($attributes->CreditCard));
        }
        if (isset($attributes->alternatePaymentMethod)) {
            $this->setAlternatePaymentMethod($attributes->alternatePaymentMethod);
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('BillShipper');

        if ($this->getAccountNumber()) {
            $node->appendChild($document->createElement('AccountNumber', $this->getAccountNumber()));
        } elseif ($creditCard = $this->getCreditCard()) {
            $node->appendChild($creditCard->toNode($document));
        } elseif ($type = $this->getAlternatePaymentMethod()) {
            $node->appendChild($document->createElement('AlternatePaymentMethod', $type));
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

    /**
     * @param string $type
     * @return BillShipper
     */
    public function setAlternatePaymentMethod($type)
    {
        $this->alternatePaymentMethod = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAlternatePaymentMethod()
    {
        return $this->alternatePaymentMethod;
    }
}
