<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;

class AddressArtifactFormat extends Address
{
    /**
     * @var string
     */
    private $country;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Country)) {
                $this->setCountryCode($attributes->Country);
            }
        }

        parent::__construct($attributes);
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

        $node = $document->createElement('AddressArtifactFormat');

        for ($i = 1; $i <= 3; $i++) {
            $line = $this->{'getPoliticalDivision'.$i}();
            if ($line) {
                $node->appendChild($document->createElement('PoliticalDivision'.$i, ($line) !== null ? htmlspecialchars($line) : null));
            }
        }

        if ($this->getCountryCode()) {
            $node->appendChild($document->createElement('CountryCode', ($this->getCountryCode()) !== null ? htmlspecialchars($this->getCountryCode()) : null));
        }
        if ($this->getCountry()) {
            $node->appendChild($document->createElement('Country', ($this->getCountry()) !== null ? htmlspecialchars($this->getCountry()) : null));
        }
        if ($this->getPostcodePrimaryHigh()) {
            $node->appendChild($document->createElement('PostcodePrimaryHigh', ($this->getPostcodePrimaryHigh()) !== null ? htmlspecialchars($this->getPostcodePrimaryHigh()) : null));
        }
        if ($this->getPostcodePrimaryLow()) {
            $node->appendChild($document->createElement('PostcodePrimaryLow', ($this->getPostcodePrimaryLow()) !== null ? htmlspecialchars($this->getPostcodePrimaryLow()) : null));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
}
