<?php
namespace Ups\Entity;

use Ups\NodeInterface;
use DOMDocument;
use DOMElement;

class PackageServiceOptions implements NodeInterface
{
    /** @deprecated */
    public $COD;
    /** @deprecated */
    public $InsuredValue;
    /** @deprecated */
    public $EarliestDeliveryTime;
    /** @deprecated */
    public $HazardousMaterialsCode;
    /** @deprecated */
    public $HoldForPickup;

    private $cod;
    private $insuredValue;
    private $earliestDeliveryTime;
    private $hazardousMaterialsCode;
    private $holdForPickup;

    function __construct($response = null)
    {

        if (null != $response) {
            if (isset($response->COD)) {
                $this->setCOD(new COD($response->COD));
            }
            if (isset($response->InsuredValue)) {
                $this->setInsuredValue(new InsuredValue($response->InsuredValue));
            }
            if (isset($response->EarliestDeliveryTime)) {
                $this->setEarliestDeliveryTime($response->EarliestDeliveryTime);
            }
            if (isset($response->HazardousMaterialsCode)) {
                $this->setHazardousMaterialsCode($response->HazardousMaterialsCode);
            }
            if (isset($response->HoldForPickup)) {
                $this->setHoldForPickup($response->HoldForPickup);
            }
        }
    }

    /**
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

        return $node;
    }

    public function getInsuredValue() {
        return $this->insuredValue;
    }

    public function setInsuredValue($var) {
        $this->InsuredValue = $var;
        $this->insuredValue = $var;
    }

    public function getCOD() {
        return $this->cod;
    }

    public function setCOD($var) {
        $this->COD = $var;
        $this->cod= $var;
    }

    public function getEarliestDeliveryTime() {
        return $this->earliestDeliveryTime;
    }

    public function setEarliestDeliveryTime($var) {
        $this->earliestDeliveryTime = $var;
        $this->EarliestDeliveryTime = $var;
    }

    public function getHazardousMaterialsCode() {
        return $this->hazardousMaterialsCode;
    }

    public function setHazardousMaterialsCode($var) {
        $this->HazardousMaterialsCode = $var;
        $this->hazardousMaterialsCode = $var;
    }

    public function getHoldForPickup() {
        return $this->holdForPickup;
    }

    public function setHoldForPickup($var) {
        $this->HoldForPickup = $var;
        $this->holdForPickup = $var;
    }

}