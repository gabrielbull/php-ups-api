<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use DOMNode;
use Ups\Entity\Phone;
use Ups\NodeInterface;

class PickupAddress implements NodeInterface
{
    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $contactName;

    /**
     * @var string
     */
    private $addressLine;

    /**
     * @var int|null
     */
    private $room;

    /**
     * @var string|null
     */
    private $floor;

    /**
     * @var string
     */
    private $city;

    /**
     * @var null|string
     */
    private $stateProvince;

    /**
     * @var null|string
     */
    private $urbanization;

    /**
     * ISO-3166 2 char.
     * @var string
     */
    private $countryCode;

    /**
     * @var null|string
     */
    private $postalCode;

    /**
     * @var bool
     */
    private $residentialIndicator;

    /**
     * @var null|string
     */
    private $pickupPoint;

    /**
     * @var Phone
     */
    private $phone;

    public function __construct(string $companyName, string $contactName, string $addressLine, ?int $room, ?string $floor, string $city, ?string $stateProvince, ?string $urbanization, string $countryCode, ?string $postalCode, bool $residentialIndicator, ?string $pickupPoint, Phone $phone)
    {
        $this->companyName = $companyName;
        $this->contactName = $contactName;
        $this->addressLine = $addressLine;
        $this->room = $room;
        $this->floor = $floor;
        $this->city = $city;
        $this->stateProvince = $stateProvince;
        $this->urbanization = $urbanization;
        $this->countryCode = $countryCode;
        $this->postalCode = $postalCode;
        $this->residentialIndicator = $residentialIndicator;
        $this->pickupPoint = $pickupPoint;
        $this->phone = $phone;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function getAddressLine(): string
    {
        return $this->addressLine;
    }

    public function getRoom(): ?int
    {
        return $this->room;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStateProvince(): ?string
    {
        return $this->stateProvince;
    }

    public function getUrbanization(): ?string
    {
        return $this->urbanization;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function isResidentialIndicator(): bool
    {
        return $this->residentialIndicator;
    }

    public function getPickupPoint(): ?string
    {
        return $this->pickupPoint;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PickupAddress');

        $node->appendChild($document->createElement('CompanyName', $this->getCompanyName()));
        $node->appendChild($document->createElement('ContactName', $this->getContactName()));
        $node->appendChild($document->createElement('AddressLine', $this->getAddressLine()));
        $node->appendChild($document->createElement('City', $this->getCity()));
        $node->appendChild($document->createElement('CountryCode', $this->getCountryCode()));
        $node->appendChild($this->getPhone()->toNode($document));
        $node->appendChild($document->createElement('ResidentialIndicator', $this->isResidentialIndicator() ? 'Y' : 'N'));

        if ($this->getRoom()) {
            $node->appendChild($document->createElement('Room', $this->getRoom()));
        }

        if ($this->getFloor()) {
            $node->appendChild($document->createElement('Floor', $this->getFloor()));
        }

        if ($this->getStateProvince()) {
            $node->appendChild($document->createElement('StateProvince', $this->getStateProvince()));
        }

        if ($this->getUrbanization()) {
            $node->appendChild($document->createElement('Urbanization', $this->getUrbanization()));
        }

        if ($this->getPostalCode()) {
            $node->appendChild($document->createElement('PostalCode', $this->getPostalCode()));
        }

        if ($this->getPickupPoint()) {
            $node->appendChild($document->createElement('PickupPoint', $this->getPickupPoint()));
        }

        return $node;
    }
}
