<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class VendorInfo implements NodeInterface
{
    /**
     * @var string
     */
    private $vendorCollectIDTypeCode;

    /**
     * @var string
     */
    private $vendorCollectIDNumber;

    /**
     * @var string
     */
    private $consigneeType;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->VendorCollectIDTypeCode)) {
                $this->setVendorCollectIDTypeCode($attributes->VendorCollectIDTypeCode);
            }
            if (isset($attributes->VendorCollectIDNumber)) {
                $this->setVendorCollectIDNumber($attributes->VendorCollectIDNumber);
            }
            if (isset($attributes->ConsigneeType)) {
                $this->setConsigneeType($attributes->ConsigneeType);
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

        $node = $document->createElement('VendorInfo');
        if ($this->getVendorCollectIDTypeCode()) {
            $node->appendChild($document->createElement('VendorCollectIDTypeCode', $this->getVendorCollectIDTypeCode()));
        }

        if ($this->getVendorCollectIDNumber()) {
            $node->appendChild($document->createElement('VendorCollectIDNumber', $this->getVendorCollectIDNumber()));
        }
        if ($this->getConsigneeType()) {
            $node->appendChild($document->createElement('ConsigneeType', $this->getConsigneeType()));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getVendorCollectIDTypeCode()
    {
        return $this->vendorCollectIDTypeCode;
    }

    /**
     * @param string $vendorCollectIDTypeCode
     *
     * @return $this
     */
    public function setVendorCollectIDTypeCode($vendorCollectIDTypeCode)
    {
        $this->vendorCollectIDTypeCode = $vendorCollectIDTypeCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getVendorCollectIDNumber()
    {
        return $this->vendorCollectIDNumber;
    }

    /**
     * @param string vendorCollectIDNumber
     *
     * @return $this
     */
    public function setVendorCollectIDNumber($vendorCollectIDNumber)
    {
        $this->vendorCollectIDNumber = $vendorCollectIDNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getConsigneeType()
    {
        return $this->consigneeType;
    }

    /**
     * @param string $consigneeType
     *
     * @return $this
     */
    public function setConsigneeType($consigneeType)
    {
        $this->consigneeType = $consigneeType;

        return $this;
    }
}
