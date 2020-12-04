<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;
use Ups\ValueObject\CardType;

class ChargeCard implements NodeInterface
{
    /**
     * @var null|string
     */
    private $cardHolderName;

    /**
     * @var CardType
     */
    private $cardType;

    /**
     * @var string
     */
    private $cardNumber;

    /**
     * @var string Format: yyyyMM
     */
    private $expirationDate;

    /**
     * @var string
     */
    private $securityCode;

    /**
     * @var CardAddress
     */
    private $cardAddress;

    public function __construct(?string $cardHolderName, CardType $cardType, string $cardNumber, string $expirationDate, string $securityCode, CardAddress $cardAddress)
    {
        $this->cardHolderName = $cardHolderName;
        $this->cardType = $cardType;
        $this->cardNumber = $cardNumber;
        $this->expirationDate = $expirationDate;
        $this->securityCode = $securityCode;
        $this->cardAddress = $cardAddress;
    }

    public function getCardHolderName(): ?string
    {
        return $this->cardHolderName;
    }

    public function getCardType(): CardType
    {
        return $this->cardType;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    public function getSecurityCode(): string
    {
        return $this->securityCode;
    }

    public function getCardAddress(): CardAddress
    {
        return $this->cardAddress;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ChargeCard');

        if ($this->getCardHolderName()) {
            $node->appendChild($document->createElement('CardHolderName', $this->getCardHolderName()));
        }

        $node->appendChild($document->createElement('CardType', $this->getCardType()->get()));
        $node->appendChild($document->createElement('CardNumber', $this->getCardNumber()));
        $node->appendChild($document->createElement('ExpirationDate', $this->getExpirationDate()));
        $node->appendChild($document->createElement('SecurityCode', $this->getSecurityCode()));
        $node->appendChild($this->getCardAddress()->toNode($document));

        return $node;
    }
}
