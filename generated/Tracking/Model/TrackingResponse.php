<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class TrackingResponse
{
    /**
     * @var Shipment[]|null
     */
    protected $shipment;

    /**
     * @return Shipment[]|null
     */
    public function getShipment(): ?array
    {
        return $this->shipment;
    }

    /**
     * @param Shipment[]|null $shipment
     */
    public function setShipment(?array $shipment): self
    {
        $this->shipment = $shipment;

        return $this;
    }
}
