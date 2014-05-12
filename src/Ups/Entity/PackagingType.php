<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class PackagingType implements NodeInterface
{
    const PT_UNKONW = '00';
    const PT_UPSLETTER = '01';
    const PT_PACKAGE = '02';
    const PT_TUBE = '03';
    const PT_PAK = '04';
    const PT_EXPRESSBOX = '21';
    const PT_25KGBOX = '24';
    const PT_10KGBOX = '25';
    const PT_PALLET = '30';
    const PT_EXPRESSBOX_SM = '2a';
    const PT_EXPRESSBOX_MD = '2b';
    const PT_EXPRESSBOX_L = '2c';

    /** @deprecated */
    public $Code = self::PT_UNKONW;
    /** @deprecated */
    public $Description;

    /**
     * @var string
     */
    private $code = self::PT_UNKONW;

    /**
     * @var string
     */
    private $description;

    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('PackagingType');
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