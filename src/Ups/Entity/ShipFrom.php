<?php
namespace Ups\Entity;

use DOMElement;
use Ups\NodeInterface;

class ShipFrom extends Shipper implements NodeInterface
{
    /**
     * @return DOMElement
     */
    public function toNode()
    {
        $node = new DOMElement('ShipFrom');
        $node->appendChild(new DOMElement('CompanyName', null)); // fixme replace null by CompanyName
        $node->appendChild(new DOMElement('AttentionName', $this->getAttentionName()));

        $address = $this->getAddress();
        if (isset($address)) {
            $node->appendChild($address->toNode());
        }

        return $node;
    }
}