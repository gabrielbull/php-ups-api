<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use DOMNode;
use Ups\NodeInterface;

class MerchantAccountNumber implements NodeInterface
{
    /**
     * @var string
     */
    private $merchantAccountNumber;

    /**
     * MerchantAccountNumber constructor.
     *
     * @param string $merchantAccountNumber
     */
    public function __construct($merchantAccountNumber)
    {
        $this->merchantAccountNumber = $merchantAccountNumber;
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMNode
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        /** @var DOMElement $node */
        $node = $document->createElement('MerchantAccountNumber', $this->getMerchantAccountNumber());

        return $node;
    }

    /**
     * @return string
     */
    public function getMerchantAccountNumber()
    {
        return $this->merchantAccountNumber;
    }

    /**
     * @param string $merchantAccountNumber
     */
    public function setMerchantAccountNumber($merchantAccountNumber)
    {
        $this->merchantAccountNumber = $merchantAccountNumber;
    }
}
