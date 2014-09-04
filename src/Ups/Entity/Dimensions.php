<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Dimensions implements NodeInterface
{
    /** @deprecated */
    public $Length;
    /** @deprecated */
    public $Width;
    /** @deprecated */
    public $Height;

    private $length;
    private $width;
    private $height;

    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    function __construct($response = null)
    {
        $this->setUnitOfMeasurement(new UnitOfMeasurement);

        if (null != $response) {
            if (isset($response->Length)) {
                $this->setLength($response->Length);
            }
            if (isset($response->Width)) {
                $this->setWidth($response->Width);
            }
            if (isset($response->Height)) {
                $this->setHeight($response->Height);
            }
        }
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

        $node = $document->createElement('Dimensions');
        $node->appendChild($document->createElement('Length', $this->getLength()));
        $node->appendChild($document->createElement('Height', $this->getHeight()));
        $node->appendChild($document->createElement('Width', $this->getWidth()));
        $node->appendChild($this->getUnitOfMeasurement()->toNode($document));
        return $node;
    }

    /**
     * @return UnitOfMeasurement
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @param UnitOfMeasurement $unitOfMeasurement
     * @return $this
     */
    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement)
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
        return $this;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($var) {
        $this->length = $var;
        $this->Length = $var;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($var) {
        $this->Width = $var;
        $this->width = $var;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($var) {
        $this->height = $var;
        $this->Height = $var;
    }
} 