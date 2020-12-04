<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use DOMNode;
use Ups\NodeInterface;
use Ups\ValueObject\ContainerCode;
use Ups\ValueObject\Quantity;

class PickupPiece implements NodeInterface
{
    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var Quantity
     */
    private $quantity;

    /**
     * @var string
     */
    private $destinationCode;

    /**
     * @var ContainerCode
     */
    private $containerCode;

    public function __construct(string $serviceCode, Quantity $quantity, string $destinationCode, ContainerCode $containerCode)
    {
        $this->serviceCode = $serviceCode;
        $this->quantity = $quantity;
        $this->destinationCode = $destinationCode;
        $this->containerCode = $containerCode;
    }

    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    public function getDestinationCode(): string
    {
        return $this->destinationCode;
    }

    public function getContainerCode(): ContainerCode
    {
        return $this->containerCode;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PickupPiece');

        $node->appendChild($document->createElement('ServiceCode', $this->getServiceCode()));
        $node->appendChild($document->createElement('Quantity', $this->getQuantity()->get()));
        $node->appendChild($document->createElement('DestinationCountryCode', $this->getDestinationCode()));
        $node->appendChild($document->createElement('ContainerCode', $this->getContainerCode()->get()));

        return $node;
    }
}
