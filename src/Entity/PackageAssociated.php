<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class PackageAssociated implements NodeInterface
{

    /**
     * @var string
     */
    private $packageNumber;

    /**
     * @var string
     */
    private $productAmount;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->PackageNumber)) {
                $this->setPackageNumber($attributes->PackageNumber);
            }
            if (isset($attributes->ProductAmount)) {
                $this->setProductAmount($attributes->ProductAmount);
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

        $node = $document->createElement('PackageAssociated');

        if ($this->getPackageNumber() !== null) {
            $node->appendChild($document->createElement('PackageNumber', $this->getPackageNumber()));
        }
        if ($this->getProductAmount() !== null) {
            $node->appendChild($document->createElement('ProductAmount', $this->getProductAmount()));
        }

        return $node;
    }

    /**
     * @param $packageNumber
     *
     * @return $this
     */
    public function setPackageNumber($packageNumber)
    {
        $this->packageNumber = $packageNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getPackageNumber()
    {
        return $this->packageNumber;
    }

    /**
     * @param string $ProductAmount
     *
     * @return $this
     */
    public function setProductAmount($ProductAmount)
    {
        $this->productAmount = $ProductAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductAmount()
    {
        return $this->productAmount;
    }
}
