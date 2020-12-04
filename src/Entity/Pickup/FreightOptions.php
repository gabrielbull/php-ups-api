<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class FreightOptions implements NodeInterface
{
    /**
     * @var null|ShipmentServiceOptions
     */
    private $shipmentServiceOptions;

    /**
     * @var null|string
     */
    private $originServiceCenterCode;

    /**
     * @var null|string
     */
    private $originServiceCountryCode;

    /**
     * @var null|DestinationAddress
     */
    private $destinationAddress;

    /**
     * @var ShipmentDetails
     */
    private $shipmentDetails;

    public function __construct(?ShipmentServiceOptions $shipmentServiceOptions, ?string $originServiceCenterCode, ?string $originServiceCountryCode, ?DestinationAddress $destinationAddress, ShipmentDetails $shipmentDetails)
    {
        $this->shipmentServiceOptions = $shipmentServiceOptions;
        $this->originServiceCenterCode = $originServiceCenterCode;
        $this->originServiceCountryCode = $originServiceCountryCode;
        $this->destinationAddress = $destinationAddress;
        $this->shipmentDetails = $shipmentDetails;
    }

    public function getShipmentServiceOptions(): ?ShipmentServiceOptions
    {
        return $this->shipmentServiceOptions;
    }

    public function getOriginServiceCenterCode(): ?string
    {
        return $this->originServiceCenterCode;
    }

    public function getOriginServiceCountryCode(): ?string
    {
        return $this->originServiceCountryCode;
    }

    public function getDestinationAddress(): ?DestinationAddress
    {
        return $this->destinationAddress;
    }

    public function getShipmentDetails(): ShipmentDetails
    {
        return $this->shipmentDetails;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('FreightOptions');

        $node->appendChild($this->getShipmentDetails()->toNode($document));

        if ($this->getShipmentServiceOptions()) {
            $node->appendChild($this->getShipmentServiceOptions()->toNode($document));
        }

        if ($this->getOriginServiceCenterCode()) {
            $node->appendChild($document->createElement('OriginServiceCenterCode', $this->getOriginServiceCenterCode()));
        }

        if ($this->getOriginServiceCountryCode()) {
            $node->appendChild($document->createElement('OriginServiceCountryCode', $this->getOriginServiceCountryCode()));
        }

        if ($this->getDestinationAddress()) {
            $node->appendChild($this->getDestinationAddress()->toNode($document));
        }

        return $node;
    }
}
