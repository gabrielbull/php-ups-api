<?php

namespace Ups\Entity;

use Ups\Entity\RatingServiceSelectionRequest\Shipment\RateInformation;

class Shipment
{
    private ?PaymentInformation $paymentInformation = null;

    private ?ItemizedPaymentInformation $itemizedPaymentInformation = null;

    private ?RateInformation $rateInformation;

    private string $description;

    private ?Shipper $shipper = null;

    private ?ShipTo $shipTo = null;

    private ?SoldTo $soldTo = null;

    private ?ShipFrom $shipFrom = null;

    private ?AlternateDeliveryAddress $alternateDeliveryAddress = null;

    private ?ShipmentIndicationType $shipmentIndicationType = null;

    private ?Service $service = null;

    private ?ReturnService $returnService = null;

    private bool $documentsOnly;

    /**
     * @var Package[]
     */
    private array $packages = [];

    private ?ReferenceNumber $referenceNumber = null;

    private ?ReferenceNumber $referenceNumber2 = null;

    private ?ShipmentServiceOptions $shipmentServiceOptions = null;

    private bool $goodsNotInFreeCirculationIndicator;

    private string $movementReferenceNumber;

    private ?InvoiceLineTotal $invoiceLineTotal = null;

    private ?ShipmentTotalWeight $shipmentTotalWeight = null;

    private string $numOfPiecesInShipment;

    private ?DeliveryTimeInformation $deliveryTimeInformation = null;

    private bool $taxInformationIndicator;

    private string $locale;

    public function __construct(
        bool $serviceInitialized = true,
        bool $shipmentServiceOptionsInitialized = true,
        bool $taxInformationIndicator = true,
        bool $deliveryTimeInformation = true,
        bool $shipmentTotalWeight = true,
        bool $rateInformation = false
    ) {
        $this->setShipper(new Shipper());
        $this->setShipTo(new ShipTo());

        if ($serviceInitialized) {
            $this->setService(new Service());
        }

        if ($shipmentServiceOptionsInitialized) {
            $this->setShipmentServiceOptions(new ShipmentServiceOptions());
        }
        if ($rateInformation) {
            $this->showNegotiatedRates();
        }

        $this->rateInformation = null;

        if ($taxInformationIndicator) {
            $this->setTaxInformationIndicator(true);
        }

        if ($deliveryTimeInformation) {
            $this->setDeliveryTimeInformation(new DeliveryTimeInformation());
        }
        if ($shipmentTotalWeight) {
            $this->setShipmentTotalWeight(new ShipmentTotalWeight());
        }
    }

    public function getShipmentIndicationType(): ?ShipmentIndicationType
    {
        return $this->shipmentIndicationType;
    }

    /**
     * @param ShipmentIndicationType $shipmentIndicationType
     */
    public function setShipmentIndicationType(ShipmentIndicationType $shipmentIndicationType): void
    {
        $this->shipmentIndicationType = $shipmentIndicationType;
    }

    /**
     * @return AlternateDeliveryAddress
     */
    public function getAlternateDeliveryAddress(): ?AlternateDeliveryAddress
    {
        return $this->alternateDeliveryAddress;
    }


    public function setAlternateDeliveryAddress(AlternateDeliveryAddress $alternateDeliveryAddress): void
    {
        $this->alternateDeliveryAddress = $alternateDeliveryAddress;
    }

    /**
     * @param Package $package
     *
     * @return void
     */
    public function addPackage(Package $package): void
    {
        $packages = $this->getPackages();
        $packages[] = $package;
        $this->setPackages($packages);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param ReferenceNumber $referenceNumber
     *
     * @return void
     */
    public function setReferenceNumber(ReferenceNumber $referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * @param ReferenceNumber $referenceNumber
     */
    public function setReferenceNumber2(ReferenceNumber $referenceNumber): void
    {
        $this->referenceNumber2 = $referenceNumber;
    }

    /**
     * @return ReferenceNumber
     */
    public function getReferenceNumber(): ?ReferenceNumber
    {
        return $this->referenceNumber;
    }

    /**
     * @return ReferenceNumber
     */
    public function getReferenceNumber2(): ?ReferenceNumber
    {
        return $this->referenceNumber2;
    }

    /**
     * @return bool
     */
    public function getDocumentsOnly(): bool
    {
        return $this->documentsOnly;
    }

    /**
     * @param bool $documentsOnly
     *
     * @return void
     */
    public function setDocumentsOnly(bool $documentsOnly): void
    {
        $this->documentsOnly = $documentsOnly;
    }

    /**
     * @return Package[]
     */
    public function getPackages(): array
    {
        return $this->packages;
    }

    /**
     * @param Package[] $packages
     *
     * @return void
     */
    public function setPackages(array $packages): void
    {
        $this->packages = $packages;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    /**
     * @param Service $service
     *
     * @return void
     */
    public function setService(Service $service): void
    {
        $this->service = $service;
    }

    /**
     * @return ReturnService
     */
    public function getReturnService(): ?ReturnService
    {
        return $this->returnService;
    }

    /**
     * @param ReturnService $returnService
     *
     * @return void
     */
    public function setReturnService(ReturnService $returnService): void
    {
        $this->returnService = $returnService;
    }

    /**
     * @return ShipFrom
     */
    public function getShipFrom(): ?ShipFrom
    {
        return $this->shipFrom;
    }

    /**
     * @param ShipFrom $shipFrom
     *
     * @return void
     */
    public function setShipFrom(ShipFrom $shipFrom): void
    {
        $this->shipFrom = $shipFrom;
    }

    /**
     * @return ShipTo
     */
    public function getShipTo(): ?ShipTo
    {
        return $this->shipTo;
    }

    /**
     * @param ShipTo $shipTo
     *
     * @return void
     */
    public function setShipTo(ShipTo $shipTo): void
    {
        $this->shipTo = $shipTo;
    }

    /**
     * @return SoldTo
     */
    public function getSoldTo(): ?SoldTo
    {
        return $this->soldTo;
    }

    /**
     * @param SoldTo $soldTo
     *
     * @return void
     */
    public function setSoldTo(SoldTo $soldTo): void
    {
        $this->soldTo = $soldTo;
    }

    /**
     * @return ShipmentServiceOptions
     */
    public function getShipmentServiceOptions(): ?ShipmentServiceOptions
    {
        return $this->shipmentServiceOptions;
    }

    public function setShipmentServiceOptions(ShipmentServiceOptions $shipmentServiceOptions): void
    {
        $this->shipmentServiceOptions = $shipmentServiceOptions;
    }

    /**
     * @return Shipper
     */
    public function getShipper(): ?Shipper
    {
        return $this->shipper;
    }

    /**
     * @param Shipper $shipper
     *
     * @return void
     */
    public function setShipper(Shipper $shipper): void
    {
        $this->shipper = $shipper;
    }

    /**
     * @return PaymentInformation
     */
    public function getPaymentInformation(): ?PaymentInformation
    {
        return $this->paymentInformation;
    }

    /**
     * @param PaymentInformation $paymentInformation
     *
     * @return void
     */
    public function setPaymentInformation(PaymentInformation $paymentInformation): void
    {
        $this->paymentInformation = $paymentInformation;
    }

    /**
     * @return ItemizedPaymentInformation
     */
    public function getItemizedPaymentInformation(): ?ItemizedPaymentInformation
    {
        return $this->itemizedPaymentInformation;
    }

    /**
     * @param ItemizedPaymentInformation $itemizedPaymentInformation
     *
     * @return void
     */
    public function setItemizedPaymentInformation(ItemizedPaymentInformation $itemizedPaymentInformation): void
    {
        $this->itemizedPaymentInformation = $itemizedPaymentInformation;
    }

    /**
     * If called, returned prices will include negotiated rates (discounts will be applied).
     */
    public function showNegotiatedRates(): void
    {
        $this->rateInformation = new RateInformation();
        $this->rateInformation->setNegotiatedRatesIndicator('true');
    }

    /**
     * @return null|RateInformation
     */
    public function getRateInformation()
    {
        return $this->rateInformation;
    }

    /**
     * @param RateInformation $rateInformation
     *
     * @return void
     */
    public function setRateInformation(RateInformation $rateInformation): void
    {
        $this->rateInformation = $rateInformation;
    }

    /**
     * @return boolean
     */
    public function getGoodsNotInFreeCirculationIndicator(): bool
    {
        return $this->goodsNotInFreeCirculationIndicator;
    }

    /**
     * @param boolean $goodsNotInFreeCirculationIndicator
     * @return void
     */
    public function setGoodsNotInFreeCirculationIndicator(bool $goodsNotInFreeCirculationIndicator): void
    {
        $this->goodsNotInFreeCirculationIndicator = $goodsNotInFreeCirculationIndicator;
    }

    /**
     * @return string
     */
    public function getMovementReferenceNumber(): string
    {
        return $this->movementReferenceNumber;
    }

    /**
     * @param string $movementReferenceNumber
     * @return void
     */
    public function setMovementReferenceNumber(string $movementReferenceNumber): void
    {
        $this->movementReferenceNumber = $movementReferenceNumber;
    }

    /**
     * @return InvoiceLineTotal
     */
    public function getInvoiceLineTotal(): ?InvoiceLineTotal
    {
        return $this->invoiceLineTotal;
    }

    /**
     * @param InvoiceLineTotal $invoiceLineTotal
     * @return Shipment
     */
    public function setInvoiceLineTotal(InvoiceLineTotal $invoiceLineTotal)
    {
        $this->invoiceLineTotal = $invoiceLineTotal;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumOfPiecesInShipment()
    {
        return $this->numOfPiecesInShipment;
    }

    /**
     * @param string $numOfPiecesInShipment
     * @return void
     */
    public function setNumOfPiecesInShipment(string $numOfPiecesInShipment): void
    {
        $this->numOfPiecesInShipment = $numOfPiecesInShipment;
    }

    /**
     * @return DeliveryTimeInformation
     */
    public function getDeliveryTimeInformation(): ?DeliveryTimeInformation
    {
        return $this->deliveryTimeInformation;
    }

    public function setDeliveryTimeInformation(DeliveryTimeInformation $deliveryTimeInformation): void
    {
        $this->deliveryTimeInformation = $deliveryTimeInformation;
    }

    public function getShipmentTotalWeight(): ?ShipmentTotalWeight
    {
        return $this->shipmentTotalWeight;
    }

    /**
     * @param ShipmentTotalWeight $shipmentTotalWeight
     */
    public function setShipmentTotalWeight(ShipmentTotalWeight $shipmentTotalWeight): void
    {
        $this->shipmentTotalWeight = $shipmentTotalWeight;
    }

    public function getTaxInformationIndicator(): bool
    {
        return $this->taxInformationIndicator;
    }

    /**
     * If called, returned prices will include Tax Information
     */
    public function setTaxInformationIndicator(bool $taxInformationIndicator): void
    {
        $this->taxInformationIndicator = $taxInformationIndicator;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return void
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
