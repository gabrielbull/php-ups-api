<?php

namespace Ups\Entity;

use DOMDocument;
use Ups\NodeInterface;

class OriginAddress implements NodeInterface
{
    private $landmarkCode;
    private $phoneNumber;
    private $geoCode;
    private $addressKeyFormat;
    private $maximumListSize;

    /**
     * @param null|DOMDocument $document
     * @return \DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('OriginAddress');
        if ($this->getPhoneNumber()) {
            $node->appendChild($document->createElement('AddressLine1', $this->getPhoneNumber()));
        }

        if ($this->getGeoCode()) {
            $node->appendChild($this->getGeoCode()->toNode($document));
        }

        if ($this->getAddressKeyFormat()) {
            $node->appendChild($this->getAddressKeyFormat()->toNode($document));
        }

        if ($this->getMaximumListSize()) {
            $node->appendChild($document->createElement('MaximumListSize', $this->getMaximumListSize()));
        }

        return $node;
    }

    /**
     * @return mixed
     */
    public function getMaximumListSize()
    {
        return $this->maximumListSize;
    }

    /**
     * @param $maximumListSize
     * @return OriginAddress
     * @throws \Exception
     */
    public function setMaximumListSize($maximumListSize)
    {
        $maximumListSize = (int)$maximumListSize;

        if ($maximumListSize < 1 || $maximumListSize > 50) {
            throw new \Exception('Maximum list size: If present, indicates the maximum number of locations the client wishes to receive in response; ranges from 1 to 50 with a default value of 10');
        }

        $this->maximumListSize = $maximumListSize;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeoCode()
    {
        return $this->geoCode;
    }

    /**
     * @param GeoCode $geoCode
     * @return OriginAddress
     */
    public function setGeoCode(GeoCode $geoCode)
    {
        $this->geoCode = $geoCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddressKeyFormat()
    {
        return $this->addressKeyFormat;
    }

    /**
     * @param mixed $addressKeyFormat
     * @return OriginAddress
     */
    public function setAddressKeyFormat($addressKeyFormat)
    {
        $this->addressKeyFormat = $addressKeyFormat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLandmarkCode()
    {
        return $this->landmarkCode;
    }

    /**
     * @param mixed $landmarkCode
     * @return OriginAddress
     */
    public function setLandmarkCode($landmarkCode)
    {
        $this->landmarkCode = $landmarkCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     * @return OriginAddress
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
