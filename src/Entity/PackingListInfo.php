<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class PackingListInfo implements NodeInterface
{

    /**
     * @var PackageAssociateds
     */
    private $PackageAssociateds = [];


    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->PackageAssociateds)) {
                foreach ($attributes->PackageAssociateds as $PackageAssociated) {
                    $this->addPackageAssociated(new PackageAssociated($PackageAssociated));
                }
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

        $node = $document->createElement('PackingListInfo');

        if ($this->getPackageAssociateds() !== null) {
            foreach ($this->PackageAssociateds as $PackageAssociated) {
                $node->appendChild($PackageAssociated->toNode($document));
            }
        }

        return $node;
    }

    /**
     * @param PackageAssociated $PackageAssociated
     *
     * @return $this
     */
    public function addPackageAssociated(PackageAssociated $PackageAssociated)
    {
        $this->PackageAssociateds[] = $PackageAssociated;

        if (count($this->PackageAssociateds) > 20) {
            throw new \Exception('Maximum 20 package allowed');
        }

        return $this;
    }

    /**
     * @return PackageAssociated
     */
    public function getPackageAssociateds()
    {
        return $this->PackageAssociateds;
    }

}
