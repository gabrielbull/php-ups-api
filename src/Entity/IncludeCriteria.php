<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use DOMNode;
use Ups\NodeInterface;

class IncludeCriteria implements NodeInterface
{

    /**
     * @var ServiceOffering[]
     */
    private $serviceOfferingList;

    /**
     * not implemented yet
     *
     * @var MerchantAccountNumber[]|null
     */
    private $merchantAccountNumberList;

    /**
     * not implemented yet
     *
     * @var SearchFilter[]|null
     */
    private $searchFilter;


    public function __toString()
    {
        return $this->toNode()->ownerDocument->saveXML();
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMNode|DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        /** @var DOMElement $node */
        $node = $document->createElement('IncludeCriteria');

        $serviceOfferingList = $this->getServiceOfferingList();
        if ($serviceOfferingList) {
            $serviceOfferingListNode = $node->appendChild($document->createElement('ServiceOfferingList'));
            foreach ($serviceOfferingList as $serviceOffering) {
                $serviceOfferingListNode->appendChild($serviceOffering->toNode($document));
            }
            $node->appendChild($serviceOfferingListNode);
        }

        $merchantAccountNumberList = $this->getMerchantAccountNumberList();
        if ($merchantAccountNumberList) {
            $merchantAccountNumberNode = $node->appendChild($document->createElement('MerchantAccountNumber'));
            foreach ($merchantAccountNumberList as $merchantAccountNumber) {
                $merchantAccountNumberNode->appendChild($merchantAccountNumber->toNode($document));
            }
            $node->appendChild($merchantAccountNumberNode);
        }

        $searchFilters = $this->getSearchFilter();
        if ($searchFilters) {
            $searchFilterNode = $node->appendChild($document->createElement('SearchFilter'));
            foreach ($searchFilters as $searchFilter) {
                $searchFilterNode->appendChild($searchFilter->toNode($document));
            }
            $node->appendChild($searchFilterNode);
        }

        return $node;
    }

    /**
     * @return ServiceOffering[]
     */
    public function getServiceOfferingList()
    {
        return $this->serviceOfferingList;
    }

    /**
     * @param ServiceOffering[] $serviceOfferingList
     */
    public function setServiceOfferingList($serviceOfferingList)
    {
        $this->serviceOfferingList = $serviceOfferingList;
    }

    /**
     * @return null|MerchantAccountNumber[]
     */
    public function getMerchantAccountNumberList()
    {
        return $this->merchantAccountNumberList;
    }

    /**
     * @param null|MerchantAccountNumber[] $merchantAccountNumberList
     */
    public function setMerchantAccountNumberList($merchantAccountNumberList)
    {
        $this->merchantAccountNumberList = $merchantAccountNumberList;
    }

    /**
     * @return null|SearchFilter[]
     */
    public function getSearchFilter()
    {
        return $this->searchFilter;
    }

    /**
     * @param null|SearchFilter[] $searchFilter
     */
    public function setSearchFilter($searchFilter)
    {
        $this->searchFilter = $searchFilter;
    }
}
