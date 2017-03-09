<?php

namespace Ups\Entity;

use DOMDocument;
use Ups\NodeInterface;

/**
 * @author Thijs Wijnmaalen <thijs@wijnmaalen.name>
 */
class PackingListInfo implements NodeInterface
{
    /**
     * @var array
     */
    private $packageAssociated = [];

    /**
     * @param string $number
     * @param string $amount
     *
     * @return $this
     */
    public function addPackageAssociated($number, $amount)
    {
        $object = new \stdClass();
        $object->PackageNumber = $number;
        $object->ProductAmount = $amount;

        $this->packageAssociated[] = $object;

        return $this;
    }

    /**
     * @return $this
     */
    public function getPackageAssociated()
    {
        return $this->packageAssociated;
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

        $node = $document->createElement('PackingListInfo');

        foreach ($this->packageAssociated as $object) {
            $packageAssociated = $document->createElement('PackageAssociated');
            $packageAssociated->appendChild($document->createElement('PackageNumber', $object->PackageNumber));
            $packageAssociated->appendChild($document->createElement('ProductAmount', $object->ProductAmount));
            $node->appendChild($packageAssociated);
        }

        return $node;
    }
}

