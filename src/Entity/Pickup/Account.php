<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class Account implements NodeInterface
{
    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var string
     */
    private $accountCountryCode;

    public function __construct(string $accountNumber, string $accountCountryCode)
    {
        $this->accountNumber = $accountNumber;
        $this->accountCountryCode = $accountCountryCode;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function getAccountCountryCode(): string
    {
        return $this->accountCountryCode;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Account');

        $node->appendChild($document->createElement('AccountNumber', $this->getAccountNumber()));
        $node->appendChild($document->createElement('AccountCountryCode', $this->getAccountCountryCode()));

        return $node;
    }
}
