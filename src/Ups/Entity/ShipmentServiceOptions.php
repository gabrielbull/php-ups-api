<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ShipmentServiceOptions implements NodeInterface
{
    public $SaturdayPickup;
    public $SaturdayDelivery;
    public $CallTagARS;
    public $NegotiatedRatesIndicator;
    public $DirectDeliveryOnlyIndicator;

    function __construct($response = null)
    {
        $this->CallTagARS = new CallTagARS();

        if (null != $response) {
            if (isset($response->SaturdayPickup)) {
                $this->SaturdayPickup = $response->SaturdayPickup;
            }
            if (isset($response->SaturdayDelivery)) {
                $this->SaturdayDelivery = $response->SaturdayDelivery;
            }
            if (isset($response->CallTagARS)) {
                $this->CallTagARS = new CallTagARS($response->CallTagARS);
            }
            if (isset($response->NegotiatedRatesIndicator)) {
                $this->NegotiatedRatesIndicator = $response->NegotiatedRatesIndicator;
            }
            if(isset($response->DirectDeliveryOnlyIndicator)) {
                $this->DirectDeliveryOnlyIndicator = $response->DirectDeliveryOnlyIndicator;
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

        $node = $document->createElement('ShipmentServiceOptions');

        if(isset($this->DirectDeliveryOnlyIndicator)) {
            $node->appendChild($document->createElement('DirectDeliveryOnlyIndicator'));
        }

        if(isset($this->SaturdayPickup)) {
            $node->appendChild($document->createElement('SaturdayPickup'));
        }

        if(isset($this->SaturdayDelivery)) {
            $node->appendChild($document->createElement('SaturdayDelivery'));
        }

        return $node;
    }

}
