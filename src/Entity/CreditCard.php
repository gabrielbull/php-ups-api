<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class CreditCard implements NodeInterface
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $expirationDate;

    /**
     * @var string
     */
    private $securityCode;

    /**
     * @var Address
     */
    private $address;

    /**
     * @param \stdClass|null $attributes
     */
    public function __construct(\stdClass $attributes = null)
    {
        $this->setAddress(new Address(isset($attributes->Address) ? $attributes->Address : null));

        if (isset($attributes->Type)) {
            $this->setType($attributes->Type);
        }
        if (isset($attributes->Number)) {
            $this->setNumber($attributes->Number);
        }
        if (isset($attributes->ExpirationDate)) {
            $this->setExpirationDate($attributes->ExpirationDate);
        }
        if (isset($attributes->SecurityCode)) {
            $this->setSecurityCode($attributes->SecurityCode);
        }
    }

    /**
     * @param DOMDocument|null $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('CreditCard');

        $node->appendChild($document->createElement('Type', $this->getType()));
        $node->appendChild($document->createElement('Number', $this->getNumber()));
        $node->appendChild($document->createElement('ExpirationDate', $this->getExpirationDate()));

        if ($this->getSecurityCode()) {
            $node->appendChild($document->createElement('SecurityCode', $this->getSecurityCode()));
        }

        if ($this->getAddress()) {
            $node->appendChild($this->getAddress()->toNode($document));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CreditCard
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return CreditCard
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    /**
     * @param string $securityCode
     * @return CreditCard
     */
    public function setSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return CreditCard
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     * @return CreditCard
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }
}
