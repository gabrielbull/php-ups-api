<?php
namespace Ups\Entity;

use Ups\NodeInterface;
use DOMDocument;
use DOMElement;

class InsuredValue implements NodeInterface
{
    /** @deprecated */
    public $CurrencyCode;
    /** @deprecated */
    public $MonetaryValue;

    private $currencyCode;
    private $monetaryValue;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->CurrencyCode)) {
                $this->setCurrencyCode($response->CurrencyCode);
            }
            if (isset($response->MonetaryValue)) {
                $this->setMonetaryValue($response->MonetaryValue);
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

        $node = $document->createElement('InsuredValue');
        $node->appendChild($document->createElement('CurrencyCode', $this->getCurrencyCode()));
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));

        return $node;
    }

    public function getCurrencyCode() {
        return $this->currencyCode;
    }

    public function setCurrencyCode($var) {
        $this->CurrencyCode = $var;
        $this->currencyCode = $var;
    }

    public function getMonetaryValue() {
        return $this->monetaryValue;
    }

    public function setMonetaryValue($var) {
        $this->MonetaryValue = $var;
        $this->monetaryValue = $var;
    }

} 