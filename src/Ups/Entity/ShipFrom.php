<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ShipFrom extends Shipper implements NodeInterface
{
    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ShipFrom');
        $node->appendChild($document->createElement('CompanyName', null)); // fixme replace null by CompanyName
        $node->appendChild($document->createElement('AttentionName', $this->getAttentionName()));

        $address = $this->getAddress();
        if (isset($address)) {
            $node->appendChild($address->toNode($document));
        }

        return $node;
    }
}