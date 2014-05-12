<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class UnitOfMeasurement implements NodeInterface
{
    // PackageWeight
    const UOM_LBS = 'LBS'; // Pounds (defalut)
    const UOM_KGS = 'KGS'; // Kilograms

    // Dimensions
    const UOM_IN = 'IN'; // Inches
    const UOM_CM = 'CM'; // Centimeters

    /** @deprecated */
    public $Code = self::UOM_LBS;
    /** @deprecated */
    public $Description;

    /**
     * @var string
     */
    private $code = self::UOM_LBS;

    /**
     * @var string
     */
    private $description;

    /**
     * @param null|array $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        $node = $document->createElement('UnitOfMeasurement');
        $node->appendChild($document->createElement('Code', $this->getCode()));
        $node->appendChild($document->createElement('Description', $this->getDescription()));
        return $node;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->Code = $code;
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->Description = $description;
        $this->description = $description;
        return $this;
    }
}