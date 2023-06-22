<?php

namespace Ups\Entity;

use DOMDocument;
use Ups\NodeInterface;

class GeoCode implements NodeInterface
{
    private $latitude;
    private $longitude;

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Geocode');

        $node->appendChild($document->createElement('Latitude', ($this->getLatitude()) !== null ? htmlspecialchars($this->getLatitude()) : null));
        $node->appendChild($document->createElement('Longitude', ($this->getLongitude()) !== null ? htmlspecialchars($this->getLongitude()) : null));

        return $node;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
}
