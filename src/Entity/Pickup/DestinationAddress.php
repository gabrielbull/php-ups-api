<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class DestinationAddress implements NodeInterface
{
    /**
     * @var null|string
     */
    private $city;

    /**
     * @var null|string
     */
    private $stateProvince;

    /**
     * @var null|string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $countryCode;

    public function __construct(?string $city, ?string $stateProvince, ?string $postalCode, string $countryCode)
    {
        $this->city = $city;
        $this->stateProvince = $stateProvince;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getStateProvince(): ?string
    {
        return $this->stateProvince;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('DestinationAddress');

        if ($this->getCity()) {
            $node->appendChild($document->createElement('City', $this->getCity()));
        }

        if ($this->getCity()) {
            $node->appendChild($document->createElement('StateProvince', $this->getStateProvince()));
        }

        if ($this->getPostalCode()) {
            $node->appendChild($document->createElement('PostalCode', $this->getPostalCode()));
        }

        $node->appendChild($document->createElement('CountryCode', $this->getCountryCode()));

        return $node;
    }
}
