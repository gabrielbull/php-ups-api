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
    private $hazmat = [];

    /**
     * @var string
     */
    private $holdForPickup;

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
        foreach($this->getHazMat() as $hazmat) {
            $node->appendChild($hazmat->toNode($document));
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
        return $this->hazmat;
    }

    /**
     * @param HazMat[] $hazmat
     */
    public function setHazMat(array $hazmat)
    {
        $this->hazmat = $hazmat;
    }

    /**
     * @param HazMat $hazmat
     */
    public function addHazMat(HazMat $hazmat)
    {
        $this->hazmat[] = $hazmat;
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
}
