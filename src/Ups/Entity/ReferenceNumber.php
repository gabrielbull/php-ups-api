<?php
namespace Ups\Entity;

use Ups\NodeInterface;
use DOMDocument;
use DOMElement;

class ReferenceNumber implements NodeInterface
{
    public $Number;
    public $Code;
    public $Value;
    public $BarCodeIndicator;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->BarCodeIndicator)) {
                $this->BarCodeIndicator = $response->BarCodeIndicator;
            }
            if (isset($response->Number)) {
                $this->Number = $response->Number;
            }
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
            if (isset($response->Value)) {
                $this->Value = $response->Value;
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

        $node = $document->createElement('ReferenceNumber');

        if($this->BarCodeIndicator) {
            $node->appendChild($document->createElement('BarCodeIndicator'));
        }
        $node->appendChild($document->createElement('Code', $this->Code));
        $node->appendChild($document->createElement('Value', $this->Value));

        return $node;
    }
} 