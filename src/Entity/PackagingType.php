<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class PackagingType implements NodeInterface
{
    public const PT_UNKNOWN = '00';
    public const PT_UPSLETTER = '01';
    public const PT_PACKAGE = '02';
    public const PT_TUBE = '03';
    public const PT_PAK = '04';
    public const PT_UPS_EXPRESSBOX = '21';
    public const PT_UPS_25KGBOX = '24';
    public const PT_UPS_10KGBOX = '25';
    public const PT_PALLET = '30';
    public const PT_EXPRESSBOX_S = '2a';
    public const PT_EXPRESSBOX_M = '2b';
    public const PT_EXPRESSBOX_L = '2c';
    public const PT_FLATS = '56';
    public const PT_PARCELS = '57';
    public const PT_BPM = '58';
    public const PT_FIRST_CLASS = '59';
    public const PT_PRIORITY = '60';
    public const PT_MACHINABLES = '61';
    public const PT_IRREGULARS = '62';
    public const PT_PARCEL_POST = '63';
    public const PT_BPM_PARCEL = '64';
    public const PT_MEDIA_MAIL = '65';
    public const PT_BPM_FLAT = '66';
    public const PT_STANDARD_FLAT = '67';

    /**
     * Required.
     * Valid Package types values are:
     * 01 = UPS Letter,
     * 02 = Customer Supplied Package,
     * 03 = Tube,
     * 04 = PAK,
     * 21 = UPS Express Box,
     * 24 = UPS 25KG Box,
     * 25 = UPS 10KG Box,
     * 30 = Pallet,
     * 2a = Small Express Box,
     * 2b = Medium Express Box,
     * 2c = Large Express Box,
     * 56 = Flats,
     * 57 = Parcels,
     * 58 = BPM,
     * 59 = First Class,
     * 60 = Priority,
     * 61 = Machinables,
     * 62 = Irregulars,
     * 63 = Parcel Post,
     *
     * 64 = BPM Parcel,
     * 65 = Media Mail,
     * 66 = BPM Flat,
     * 67 = Standard Flat
     *
     * @var string
     */
    private $code = self::PT_UNKNOWN;

    /**
     * @var null|string
     */
    private $description;

    public function __construct($attributes = null)
    {
        if (isset($attributes->Description)) {
            $this->setDescription($attributes->Description);
        }
        if (isset($attributes->Code)) {
            $this->setCode($attributes->Code);
        }
    }

    public function toNode(?DOMDocument $document = null): \DOMNode
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PackagingType');
        $node->appendChild($document->createElement('Code', $this->getCode()));
        $node->appendChild($document->createElement('Description', $this->getDescription()));

        return $node;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
