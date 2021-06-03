<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class HazMatPackageInformation
 * @package Ups\Entity
 */
class HazMatPackageInformation implements NodeInterface
{

    /**
     * @var bool
     */
    private $allPackedInOneIndicator;

    /**
     * @var bool
     */
    private $overPackedIndicator;

    /**
     * @var string
     */
    private $qValue;

    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('HazMatPackageInformation');

        if ($this->isAllPackedInOneIndicator()) {
            $node->appendChild($document->createElement('AllPackedInOneIndicator'));
        }
        if ($this->isOverPackedIndicator()) {
            $node->appendChild($document->createElement('OverPackedIndicator'));
        }
        if ($this->getQValue() !== null) {
            $node->appendChild($document->createElement('QValue', $this->getQValue()));
        }

        return $node;
    }

    /**
     * @return bool
     */
    public function isAllPackedInOneIndicator()
    {
        return $this->allPackedInOneIndicator;
    }

    /**
     * @param bool $allPackedInOneIndicator
     * @return HazMatPackageInformation
     */
    public function setAllPackedInOneIndicator($allPackedInOneIndicator)
    {
        $this->allPackedInOneIndicator = $allPackedInOneIndicator;

        return $this;
    }

    /**
     * @return bool
     */
    public function isOverPackedIndicator()
    {
        return $this->overPackedIndicator;
    }

    /**
     * @param bool $overPackedIndicator
     * @return HazMatPackageInformation
     */
    public function setOverPackedIndicator($overPackedIndicator)
    {
        $this->overPackedIndicator = $overPackedIndicator;

        return $this;
    }

    /**
     * @return string
     */
    public function getQValue()
    {
        return $this->qValue;
    }

    /**
     * @param string $qValue
     * @return HazMatPackageInformation
     */
    public function setQValue($qValue)
    {
        $this->qValue = $qValue;

        return $this;
    }
}
