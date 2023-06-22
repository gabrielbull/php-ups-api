<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;

class AddressKeyFormat extends Address
{
    /**
     * @var string
     */
    private $singleLineAddress;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->SingleLineAddress)) {
                $this->setSingleLineAddress($attributes->SingleLineAddress);
            }
        }

        parent::__construct($attributes);
    }

    /**
     * @return string
     */
    public function getSingleLineAddress()
    {
        return $this->singleLineAddress;
    }

    /**
     * @param string $singleLineAddress
     */
    public function setSingleLineAddress($singleLineAddress)
    {
        $this->singleLineAddress = $singleLineAddress;
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

        $node = $document->createElement('AddressKeyFormat');

        if ($this->getConsigneeName()) {
            $node->appendChild($document->createElement('ConsigneeName', ($this->getConsigneeName()) !== null ? htmlspecialchars($this->getConsigneeName()) : null));
        }

        for ($i = 1; $i <= 3; $i++) {
            $line = $this->{'getAddressLine'.$i}();
            if ($line) {
                $node->appendChild($document->createElement('AddressLine'.($i == 1 ? '' : $i), $line));
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            $line = $this->{'getPoliticalDivision'.$i}();
            if ($line) {
                $node->appendChild($document->createElement('PoliticalDivision'.$i, ($line) !== null ? htmlspecialchars($line) : null));
            }
        }

        if ($this->getPostcodePrimaryLow()) {
            $node->appendChild($document->createElement('PostcodePrimaryLow', ($this->getPostcodePrimaryLow()) !== null ? htmlspecialchars($this->getPostcodePrimaryLow()) : null));
        }
        if ($this->getPostcodeExtendedLow()) {
            $node->appendChild($document->createElement('PostcodeExtendedLow', ($this->getPostcodeExtendedLow()) !== null ? htmlspecialchars($this->getPostcodeExtendedLow()) : null));
        }

        if ($this->getCountryCode()) {
            $node->appendChild($document->createElement('CountryCode', ($this->getCountryCode()) !== null ? htmlspecialchars($this->getCountryCode()) : null));
        }

        if ($this->getSingleLineAddress()) {
            $node->appendChild($document->createElement('SingleLineAddress', ($this->getSingleLineAddress()) !== null ? htmlspecialchars($this->getSingleLineAddress()) : null));
        }

        return $node;
    }
}
