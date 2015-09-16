<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

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
    private $hazardousMaterialsCode;
    private $holdForPickup;

    public function __construct($parameters = null)
    {
        if (null != $parameters) {
            if (isset($parameters->COD)) {
                $this->setCOD(new COD($parameters->COD));
            }
            if (isset($parameters->InsuredValue)) {
                $this->setInsuredValue(new InsuredValue($parameters->InsuredValue));
            }
            if (isset($parameters->EarliestDeliveryTime)) {
                $this->setEarliestDeliveryTime($parameters->EarliestDeliveryTime);
            }
            if (isset($parameters->HazardousMaterialsCode)) {
                $this->setHazardousMaterialsCode($parameters->HazardousMaterialsCode);
            }
            if (isset($parameters->HoldForPickup)) {
                $this->setHoldForPickup($parameters->HoldForPickup);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * TODO: this seem to be awfully incomplete
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

        return $node;
    }

    public function getInsuredValue()
    {
        return $this->insuredValue;
    }

    public function setInsuredValue($var)
    {
        $this->insuredValue = $var;
    }

    public function getCOD()
    {
        return $this->cod;
    }

    public function setCOD($var)
    {
        $this->cod = $var;
    }

    public function getEarliestDeliveryTime()
    {
        return $this->earliestDeliveryTime;
    }

    public function setEarliestDeliveryTime($var)
    {
        $this->earliestDeliveryTime = $var;
    }

    public function getHazardousMaterialsCode()
    {
        return $this->hazardousMaterialsCode;
    }

    public function setHazardousMaterialsCode($var)
    {
        $this->hazardousMaterialsCode = $var;
    }

    public function getHoldForPickup()
    {
        return $this->holdForPickup;
    }

    public function setHoldForPickup($var)
    {
        $this->holdForPickup = $var;
    }
}
