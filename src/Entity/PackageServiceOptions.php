<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class PackageServiceOptions
 * @package Ups\Entity
 */
class PackageServiceOptions implements NodeInterface
{
    /**
     * @var COD
     */
    private $cod;

    /**
     * @var InsuredValue
     */
    private $insuredValue;

    /**
     * @var string
     */
    private $earliestDeliveryTime;

    /**
     * @var HazMat[]
     */
    private $hazMat = [];

    /**
     * @var HazMatPackageInformation
     */
    private $hazMatPackageInformation;

    /**
     * @var string
     */
    private $holdForPickup;

    /**
     * @var DeliveryConfirmation
     */
    private $deliveryConfirmation;

    /**
     * @var mixed
     */
    private $ShipperReleaseIndicator;

    /**
     * @param null $parameters
     */
    public function __construct($parameters = null)
    {
        if (null !== $parameters) {
            if (isset($parameters->COD)) {
                $this->setCOD(new COD($parameters->COD));
            }
            if (isset($parameters->InsuredValue)) {
                $this->setInsuredValue(new InsuredValue($parameters->InsuredValue));
            }
            if (isset($parameters->EarliestDeliveryTime)) {
                $this->setEarliestDeliveryTime($parameters->EarliestDeliveryTime);
            }
            if (isset($parameters->HoldForPickup)) {
                $this->setHoldForPickup($parameters->HoldForPickup);
            }
            if (isset($parameters->DeliveryConfirmation)) {
                $this->setDeliveryConfirmation($parameters->DeliveryConfirmation);
            }
            if (isset($parameters->ShipperReleaseIndicator)) {
                $this->ShipperReleaseIndicator = $parameters->ShipperReleaseIndicator;
            }
        }
    }

    /**
     * @TODO: this seem to be awfully incomplete
     *
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PackageServiceOptions');

        if ($this->getInsuredValue()) {
            $node->appendChild($this->getInsuredValue()->toNode($document));
        }
        foreach ($this->getHazMat() as $hazmat) {
            $node->appendChild($hazmat->toNode($document));
        }
        if ($this->getHazMatPackageInformation() !== null) {
            $node->appendChild($this->getHazMatPackageInformation()->toNode($document));
        }
        if (isset($this->deliveryConfirmation)) {
            $node->appendChild($this->deliveryConfirmation->toNode($document));
        }
        if (isset($this->ShipperReleaseIndicator)) {
            $node->appendChild($document->createElement('ShipperReleaseIndicator'));
        }

        return $node;
    }

    /**
     * @return InsuredValue|null
     */
    public function getInsuredValue()
    {
        return $this->insuredValue;
    }

    /**
     * @param $var
     * @return PackageServiceOptions
     */
    public function setInsuredValue($var)
    {
        $this->insuredValue = $var;

        return $this;
    }

    /**
     * @return COD|null
     */
    public function getCOD()
    {
        return $this->cod;
    }

    /**
     * @param $var
     * @return PackageServiceOptions
     */
    public function setCOD($var)
    {
        $this->cod = $var;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEarliestDeliveryTime()
    {
        return $this->earliestDeliveryTime;
    }

    /**
     * @param $var
     * @return PackageServiceOptions
     */
    public function setEarliestDeliveryTime($var)
    {
        $this->earliestDeliveryTime = $var;

        return $this;
    }

    /**
     * @return HazMat[]
     */
    public function getHazMat()
    {
        return $this->hazMat;
    }

    /**
     * @param HazMat[] $hazMat
     * @return PackageServiceOptions
     */
    public function setHazMat(array $hazMat)
    {
        $this->hazMat = $hazMat;

        return $this;
    }

    /**
     * @param HazMat $hazmat
     * @return PackageServiceOptions
     */
    public function addHazMat(HazMat $hazmat)
    {
        $this->hazMat[] = $hazmat;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHoldForPickup()
    {
        return $this->holdForPickup;
    }

    /**
     * @param $var
     * @return PackageServiceOptions
     */
    public function setHoldForPickup($var)
    {
        $this->holdForPickup = $var;

        return $this;
    }

    /**
     * @return HazMatPackageInformation
     */
    public function getHazMatPackageInformation()
    {
        return $this->hazMatPackageInformation;
    }

    /**
     * @param HazMatPackageInformation $hazMatPackageInformation
     * @return PackageServiceOptions
     */
    public function setHazMatPackageInformation($hazMatPackageInformation)
    {
        $this->hazMatPackageInformation = $hazMatPackageInformation;

        return $this;
    }

    /**
     * @param DeliveryConfirmation $deliveryConfirmation
     * @return PackageServiceOptions
     */
    public function setDeliveryConfirmation(DeliveryConfirmation $deliveryConfirmation)
    {
        $this->deliveryConfirmation = $deliveryConfirmation;

        return $this;
    }

    /**
     * @return DeliveryConfirmation|null
     */
    public function getDeliveryConfirmation()
    {
        return $this->deliveryConfirmation;
    }

    /**
     * @return mixed
     */
    public function getShipperReleaseIndicator()
    {
        return $this->ShipperReleaseIndicator;
    }

    /**
     * @param mixed $ShipperReleaseIndicator
     * @return PackageServiceOptions
     */
    public function setShipperReleaseIndicator($ShipperReleaseIndicator)
    {
        $this->ShipperReleaseIndicator = $ShipperReleaseIndicator;

        return $this;
    }
}
