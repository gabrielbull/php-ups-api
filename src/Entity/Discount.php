<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Discount implements NodeInterface
{
    private $monetaryValue;

    public function __construct($response = null)
    {
        if (null !== $response) {
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
    public function getMonetaryValue()
    {
        return $this->monetaryValue;
    }

    /**
     * @param $var
     * @param int $mode
     * @return Discount
     * @throws \Exception
     */
    public function setMonetaryValue($var, $mode = PHP_ROUND_HALF_UP)
    {
        if ($var < 0) {
            throw new \Exception('Discount cannot be negative');
        }

        $var = round($var, 2, $mode); // Max 2 decimals places
        if (strlen((string)$var) > 15) {
            throw new \Exception('Value too long');
        }

        $this->monetaryValue = $var;

        return $this;
    }
}
