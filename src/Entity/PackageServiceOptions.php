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
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * @TODO: this seem to be awfully incomplete
     *
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
     */
    public function setInsuredValue($var)
    {
        $this->insuredValue = $var;
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
     */
    public function setCOD($var)
    {
        $this->cod = $var;
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
     */
    public function setEarliestDeliveryTime($var)
    {
        $this->earliestDeliveryTime = $var;
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
     */
    public function setHazMat(array $hazMat)
    {
        $this->hazMat = $hazMat;
    }

    /**
     * @param HazMat $hazmat
     */
    public function addHazMat(HazMat $hazmat)
    {
        $this->hazMat[] = $hazmat;
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
     */
    public function setHoldForPickup($var)
    {
        $this->holdForPickup = $var;
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
     */
    public function setHazMatPackageInformation($hazMatPackageInformation)
    {
        $this->hazMatPackageInformation = $hazMatPackageInformation;
    }

    /**
     * @param DeliveryConfirmation $deliveryConfirmation
     * @return ShipmentServiceOptions
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
}
