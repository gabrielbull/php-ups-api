<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class CardAddress implements NodeInterface
{
    /**
     * @var null|string
     */
    private $addressLine;

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

    public function __construct(?string $addressLine, ?string $city, ?string $stateProvince, ?string $postalCode, string $countryCode)
    {
        $this->addressLine = $addressLine;
        $this->city = $city;
        $this->stateProvince = $stateProvince;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
    }

    public function getAddressLine(): ?string
    {
        return $this->addressLine;
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

        $node = $document->createElement('CardAddress');

        if ($this->getAddressLine()) {
            $node->appendChild($document->createElement('AddressLine', $this->getAddressLine()));
        }

        if ($this->getCity()) {
            $node->appendChild($document->createElement('City', $this->getCity()));
        }

        if ($this->getPostalCode()) {
            $node->appendChild($document->createElement('PostalCode', $this->getPostalCode()));
        }

        $node->appendChild($document->createElement('CountryCode', $this->getCountryCode()));

        return $node;
    }
}
