<?php declare(strict_types=1);

namespace Ups\Entity;

use Ups\Entity\RatingServiceSelectionRequest\Request;

class RateRequest
{
    private PickupType $pickupType;
    private ?CustomerClassification $customerClassification = null;
    private Shipment $shipment;
    private Request $request;

    public function __construct()
    {
        $this->setRequest(new Request());
        $this->setShipment(new Shipment());
        $this->setPickupType(new PickupType());
    }

    public function getPickupType(): PickupType
    {
        return $this->pickupType;
    }

    public function setPickupType(PickupType $pickupType): void
    {
        $this->pickupType = $pickupType;
    }

    public function getCustomerClassification(): ?CustomerClassification
    {
        return $this->customerClassification;
    }

    public function setCustomerClassification(CustomerClassification $customerClassification): void
    {
        $this->customerClassification = $customerClassification;
    }

    public function getShipment(): Shipment
    {
        return $this->shipment;
    }

    public function setShipment(Shipment $shipment): void
    {
        $this->shipment = $shipment;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
}
