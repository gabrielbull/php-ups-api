<?php
namespace Ups\Entity;

use Ups\NodeInterface;
use DOMDocument;
use DOMElement;

class Discount implements NodeInterface
{

    private $monetaryValue;

    function __construct($response = null)
    {
        if (null != $response) {
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

        $node = $document->createElement('Discount');
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));

        return $node;
    }

    /**
     * @return mixed
     */
    public function getMonetaryValue() {
        return $this->monetaryValue;
    }

    /**
     * @param $var
     */
    public function setMonetaryValue($var) {
        $this->MonetaryValue = $var;
        $this->monetaryValue = $var;
    }

} 