<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\Entity\TotalWeight;
use Ups\NodeInterface;
use Ups\ValueObject\CashType;
use Ups\ValueObject\PaymentMethod;
use Ups\ValueObject\ServiceCategory;

class PickupCreationRequest implements NodeInterface
{
    /**
     * @var string|"Y"|"N"
     */
    private $ratePickupIndicator;

    /**
     * @var PickupDateInfo
     */
    private $pickupDateInfo;

    /**
     * @var PickupAddress
     */
    private $pickupAddress;

    /**
     * @var bool
     */
    private $alternateAddressIndicator;

    /**
     * @var PickupPiece[]
     */
    private $pickupPieces;

    /**
     * @var null|TotalWeight
     */
    private $totalWeight;

    /**
     * @var null|bool
     */
    private $overweightIndicator;

    /**
     * @var null|TrackingData
     */
    private $trackingData;

    /**
     * @var null|TrackingDataWithReferenceNumber
     */
    private $trackingDataWithReferenceNumber;

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var null|string
     */
    private $specialInstruction;

    /**
     * @var null|string
     */
    private $referenceNumber;

    /**
     * @var null|FreightOptions
     */
    private $freightOptions;

    /**
     * @var null|ServiceCategory
     */
    private $serviceCategory;

    /**
     * @var null|CashType
     */
    private $cashType;

    /**
     * @var null|bool
     */
    private $shippingLabelsAvailable;

    /**
     * @var null|Shipper
     */
    private $shipper;

    /**
     * @var bool
     */
    private $taxInformationIndicator;

    public function __construct(string $ratePickupIndicator, PickupDateInfo $pickupDateInfo, PickupAddress $pickupAddress, bool $alternateAddressIndicator, array $pickupPieces, ?TotalWeight $totalWeight, ?bool $overweightIndicator, ?TrackingData $trackingData, ?TrackingDataWithReferenceNumber $trackingDataWithReferenceNumber, PaymentMethod $paymentMethod, ?string $specialInstruction, ?string $referenceNumber, ?FreightOptions $freightOptions, ?ServiceCategory $serviceCategory, ?CashType $cashType, ?bool $shippingLabelsAvailable, ?Shipper $shipper, bool $taxInformationIndicator)
    {
        $this->ratePickupIndicator = $ratePickupIndicator;
        $this->pickupDateInfo = $pickupDateInfo;
        $this->pickupAddress = $pickupAddress;
        $this->alternateAddressIndicator = $alternateAddressIndicator;
        $this->pickupPieces = $pickupPieces;
        $this->totalWeight = $totalWeight;
        $this->overweightIndicator = $overweightIndicator;
        $this->trackingData = $trackingData;
        $this->trackingDataWithReferenceNumber = $trackingDataWithReferenceNumber;
        $this->paymentMethod = $paymentMethod;
        $this->specialInstruction = $specialInstruction;
        $this->referenceNumber = $referenceNumber;
        $this->freightOptions = $freightOptions;
        $this->serviceCategory = $serviceCategory;
        $this->cashType = $cashType;
        $this->shippingLabelsAvailable = $shippingLabelsAvailable;
        $this->shipper = $shipper;
        $this->taxInformationIndicator = $taxInformationIndicator;
    }

    public function isTaxInformationIndicator(): bool
    {
        return $this->taxInformationIndicator;
    }

    public function getRatePickupIndicator(): string
    {
        return $this->ratePickupIndicator;
    }

    public function getPickupDateInfo(): PickupDateInfo
    {
        return $this->pickupDateInfo;
    }

    public function getPickupAddress(): PickupAddress
    {
        return $this->pickupAddress;
    }

    public function isAlternateAddressIndicator(): bool
    {
        return $this->alternateAddressIndicator;
    }

    /**
     * @return array|PickupPiece[]
     */
    public function getPickupPieces(): array
    {
        return $this->pickupPieces;
    }

    public function getTotalWeight(): ?TotalWeight
    {
        return $this->totalWeight;
    }

    public function isOverweightIndicator(): ?bool
    {
        return $this->overweightIndicator;
    }

    public function getTrackingData(): ?TrackingData
    {
        return $this->trackingData;
    }

    public function getTrackingDataWithReferenceNumber(): ?TrackingDataWithReferenceNumber
    {
        return $this->trackingDataWithReferenceNumber;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function getSpecialInstruction(): ?string
    {
        return $this->specialInstruction;
    }

    public function getReferenceNumber(): ?string
    {
        return $this->referenceNumber;
    }

    public function getFreightOptions(): ?FreightOptions
    {
        return $this->freightOptions;
    }

    public function getServiceCategory(): ?ServiceCategory
    {
        return $this->serviceCategory;
    }

    public function getCashType(): ?CashType
    {
        return $this->cashType;
    }

    public function getShippingLabelsAvailable(): ?bool
    {
        return $this->shippingLabelsAvailable;
    }

    public function getShipper(): ?Shipper
    {
        return $this->shipper;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PickupCreationRequest');

        $node->appendChild($document->createElement('RatePickupIndicator', $this->getRatePickupIndicator()));
        $node->appendChild($this->getPickupDateInfo()->toNode($document));
        $node->appendChild($this->getPickupAddress()->toNode($document));

        $node->appendChild($document->createElement(
            'AlternateAddressIndicator',
            $this->isAlternateAddressIndicator() ? 'Y' : 'N'
        ));

        $node->appendChild($document->createElement(
            'PaymentMethod',
            $this->getPaymentMethod()->get()
        ));

        if ($this->getShippingLabelsAvailable()) {
            $node->appendChild($document->createElement(
                'ShippingLabelsAvailable',
                'Y'
            ));
        }

        if ($this->getReferenceNumber()) {
            $node->appendChild($document->createElement(
                'ReferenceNumber',
                $this->getReferenceNumber()
            ));
        }

        if ($this->getCashType()) {
            $node->appendChild($document->createElement(
                'CashType',
                $this->getCashType()->get()
            ));
        }

        if (null !== $this->isTaxInformationIndicator()) {
            $node->appendChild($document->createElement(
                'TaxInformationIndicator',
                $this->isTaxInformationIndicator() ? 'Y' : 'N'
            ));
        }

        if (null !== $this->getSpecialInstruction()) {
            $node->appendChild($document->createElement(
                'SpecialInstruction',
                $this->getSpecialInstruction()
            ));
        }

        if (null !== $this->isOverweightIndicator()) {
            $node->appendChild($document->createElement(
                'OverweightIndicator',
                $this->isOverweightIndicator() ? 'Y' : 'N'
            ));
        }

        if (null !== $this->getShipper()) {
            $node->appendChild($this->getShipper()->toNode($document));
        }

        foreach ($this->getPickupPieces() as $pickupPiece) {
            $node->appendChild($pickupPiece->toNode($document));
        }

        if (null !== $this->getTotalWeight()) {
            $node->appendChild($this->getTotalWeight()->toNode($document));
        }

        if (null !== $this->getTrackingData()) {
            $node->appendChild($this->getTrackingData()->toNode($document));
        }

        if (null !== $this->getTrackingDataWithReferenceNumber()) {
            $node->appendChild($this->getTrackingDataWithReferenceNumber()->toNode($document));
        }

        if ($this->getReferenceNumber()) {
            $node->appendChild($document->createElement(
                'ReferenceNumber',
                $this->getReferenceNumber()
            ));
        }

        if ($this->getFreightOptions()) {
            $node->appendChild($this->getFreightOptions()->toNode($document));
        }

        if ($this->getServiceCategory()) {
            $node->appendChild($document->createElement('ServiceCategory', $this->getServiceCategory()->get()));
        }

        return $node;
    }
}
