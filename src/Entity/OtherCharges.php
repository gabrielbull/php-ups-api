<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class OtherCharges implements NodeInterface
{
    /**
     * @var string $monetaryValue
     */
    protected $monetaryValue;

    /**
     * @var string $description;
     */
    protected $description;

    public function __construct($attributes = null)
    {
        if (null != $attributes) {
            if (isset($attributes->MonetaryValue)) {
                $this->setMonetaryValue($attributes->MonetaryValue);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('OtherCharges');
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));
        $node->appendChild($document->createElement('Description', $this->getDescription()));

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
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setMonetaryValue($var)
    {
        $this->monetaryValue = round($var, 2); // Max 2 decimals places

        if ($this->monetaryValue < 0) {
            throw new \Exception('Other charges cannot be negative');
        }

        if (strlen((string)$this->monetaryValue) > 15) {
            throw new \Exception('Value too long');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
