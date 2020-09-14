<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class AccessPointCOD implements NodeInterface
{

    /**
     * @var ?string
     */
    private $currencyCode;

    /**
     * @var ?float
     */
    private $monetaryValue;

    public function toNode(?DOMDocument $document = null): DOMElement
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('AccessPointCOD');

        $node->appendChild($document->createElement('CurrencyCode', $this->getCurrencyCode()));
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));

        return $node;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function getMonetaryValue(): ?float
    {
        return $this->monetaryValue;
    }

    public function setMonetaryValue(float $monetaryValue): void
    {
        $this->monetaryValue = $monetaryValue;
    }
}
