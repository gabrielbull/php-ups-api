<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class LocationSearchCriteria implements NodeInterface
{

    /**
     * @var string
     */
    private $accessPointSearch;

    /**
     * @return string
     */
    public function getAccessPointSearch()
    {
        return $this->accessPointSearch;
    }

    /**
     * @param string $accessPointSearch
     */
    public function setAccessPointSearch(AccessPointSearch $accessPointSearch)
    {
        $this->accessPointSearch = $accessPointSearch;
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

        $node = $document->createElement('LocationSearchCriteria');

        if($this->getAccessPointSearch()) {
            $node->appendChild($document->createElement('AccessPointSearch', $this->getAccessPointSearch()));
        }

        return $node;
    }

}