<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class ShipmentServiceOptions
 * @package Ups\Entity
 */
// @todo Refactor to private properties
class ShipmentServiceOptions implements NodeInterface
{
    const DCIS_SIGNATURE = '1';
    
    const DCIS_SIGNATURE_ADULT = '2';
    
    
    /**
     * @var boolean
     */
    public $SaturdayPickup;

    /**
     * @var boolean
     */
    public $SaturdayDelivery;

    /**
     * @var
     */
    public $COD;

    /**
     * @var CallTagARS
     */
    public $CallTagARS;

    /**
     * @var boolean
     */
    public $NegotiatedRatesIndicator;

    /**
     * @var boolean
     */
    public $DirectDeliveryOnlyIndicator;

    /**
     * @var
     */
    public $DeliverToAddresseeOnlyIndicator;

    /**
     * @var
     */
    private $internationalForms;

    /**
     * @var array
     */
    private $notifications = [];

    /**
     * @var AccessPointCOD
     */
    private $accessPointCOD;
    
    /**
     * @var int
     */
    private $DeliveryConfirmation;
    
    /**
     * @var bool
     */
    private $CarbonNeutral;

    /**
     * @param null $response
     */
    public function __construct($response = null)
    {
        $this->CallTagARS = new CallTagARS();

        if (null !== $response) {
            if (isset($response->SaturdayPickup)) {
                $this->SaturdayPickup = $response->SaturdayPickup;
            }
            if (isset($response->SaturdayDelivery)) {
                $this->SaturdayDelivery = $response->SaturdayDelivery;
            }
            if (isset($response->COD)) {
                $this->COD = $response->COD;
            }
            if (isset($response->AccessPointCOD)) {
                $this->setAccessPointCOD(new AccessPointCOD($response->AccessPointCOD));
            }
            if (isset($response->CallTagARS)) {
                $this->CallTagARS = new CallTagARS($response->CallTagARS);
            }
            if (isset($response->NegotiatedRatesIndicator)) {
                $this->NegotiatedRatesIndicator = $response->NegotiatedRatesIndicator;
            }
            if (isset($response->DirectDeliveryOnlyIndicator)) {
                $this->DirectDeliveryOnlyIndicator = $response->DirectDeliveryOnlyIndicator;
            }
            if (isset($response->DeliverToAddresseeOnlyIndicator)) {
                $this->DeliverToAddresseeOnlyIndicator = $response->DeliverToAddresseeOnlyIndicator;
            }
            if (isset($response->InternationalForms)) {
                $this->setInternationalForms($response->InternationalForms);
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
        
        $node = $document->createElement('ShipmentServiceOptions');

        if ($this->DirectDeliveryOnlyIndicator) {
            $node->appendChild($document->createElement('DirectDeliveryOnlyIndicator'));
        }

        if ($this->DeliverToAddresseeOnlyIndicator) {
            $node->appendChild($document->createElement('DeliverToAddresseeOnlyIndicator'));
        }

        if ($this->SaturdayPickup) {
            $node->appendChild($document->createElement('SaturdayPickup'));
        }

        if ($this->SaturdayDelivery) {
            $node->appendChild($document->createElement('SaturdayDelivery'));
        }
        
        if ($this->DeliveryConfirmation) {
            $deliveryConfirmation = $document->createElement('DeliveryConfirmation');
            $deliveryConfirmation->appendChild(
                $document->createElement('DCISType', $this->DeliveryConfirmation)
            );      
            $node->appendChild($deliveryConfirmation);            
        }

        if ($this->getCOD()) {
            $node->appendChild($this->getCOD()->toNode($document));
        }

        if ($this->getAccessPointCOD()) {
            $node->appendChild($this->getAccessPointCOD()->toNode($document));
        }

        if ($this->internationalForms) {
            $node->appendChild($this->internationalForms->toNode($document));
        }

        if (!empty($this->notifications)) {
            foreach ($this->notifications as $notification) {
                $node->appendChild($notification->toNode($document));
            }
        }
        
        return $node;
    }

    /**
     * @return AccessPointCOD
     */
    public function getAccessPointCOD()
    {
        return $this->accessPointCOD;
    }

    /**
     * @param $accessPointCOD
     * @return $this
     */
    public function setAccessPointCOD($accessPointCOD)
    {
        $this->accessPointCOD = $accessPointCOD;
        return $this;
    }

    /**
     * @param InternationalForms $data
     * @return $this
     */
    public function setInternationalForms(InternationalForms $data)
    {
        $this->internationalForms = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInternationalForms()
    {
        return $this->internationalForms;
    }

    /**
     * @param Notification $notification
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function addNotification(Notification $notification)
    {
        $this->notifications[] = $notification;

        if (count($this->notifications) > 3) {
            throw new \Exception('Maximum 3 notifications allowed');
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @return mixed
     */
    public function getSaturdayPickup()
    {
        return $this->SaturdayPickup;
    }

    /**
     * @param mixed $SaturdayPickup
     * @return ShipmentServiceOptions
     */
    public function setSaturdayPickup($SaturdayPickup)
    {
        $this->SaturdayPickup = $SaturdayPickup;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaturdayDelivery()
    {
        return $this->SaturdayDelivery;
    }

    /**
     * @param mixed $SaturdayDelivery
     * @return ShipmentServiceOptions
     */
    public function setSaturdayDelivery($SaturdayDelivery)
    {
        $this->SaturdayDelivery = $SaturdayDelivery;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCOD()
    {
        return $this->COD;
    }

    /**
     * @param mixed $COD
     * @return ShipmentServiceOptions
     */
    public function setCOD($COD)
    {
        $this->COD = $COD;
        return $this;
    }

    /**
     * @return CallTagARS
     */
    public function getCallTagARS()
    {
        return $this->CallTagARS;
    }

    /**
     * @param CallTagARS $CallTagARS
     * @return ShipmentServiceOptions
     */
    public function setCallTagARS($CallTagARS)
    {
        $this->CallTagARS = $CallTagARS;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isNegotiatedRatesIndicator()
    {
        return $this->NegotiatedRatesIndicator;
    }

    /**
     * @param boolean $NegotiatedRatesIndicator
     * @return ShipmentServiceOptions
     */
    public function setNegotiatedRatesIndicator($NegotiatedRatesIndicator)
    {
        $this->NegotiatedRatesIndicator = $NegotiatedRatesIndicator;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDirectDeliveryOnlyIndicator()
    {
        return $this->DirectDeliveryOnlyIndicator;
    }

    /**
     * @param boolean $DirectDeliveryOnlyIndicator
     * @return ShipmentServiceOptions
     */
    public function setDirectDeliveryOnlyIndicator($DirectDeliveryOnlyIndicator)
    {
        $this->DirectDeliveryOnlyIndicator = $DirectDeliveryOnlyIndicator;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliverToAddresseeOnlyIndicator()
    {
        return $this->DeliverToAddresseeOnlyIndicator;
    }

    /**
     * @param mixed $DeliverToAddresseeOnlyIndicator
     * @return ShipmentServiceOptions
     */
    public function setDeliverToAddresseeOnlyIndicator($DeliverToAddresseeOnlyIndicator)
    {
        $this->DeliverToAddresseeOnlyIndicator = $DeliverToAddresseeOnlyIndicator;
        return $this;
    }
        
    /**
     * @return int
     */
    public function getDeliveryConfirmation()
    {
        return $this->DeliveryConfirmation;
    }

    /**
     * @param int $DeliveryConfirmation
     * @return ShipmentServiceOptions
     */
    public function setDeliveryConfirmation($DeliveryConfirmation)
    {
        switch ($DeliveryConfirmation) {            
            case self::DCIS_SIGNATURE:
            case self::DCIS_SIGNATURE_ADULT:
                break;
            default:
                throw new \Exception("Incorrect DeliveryConfirmation type");
                break;
        }
        $this->DeliveryConfirmation = $DeliveryConfirmation;
        return $this;
    }

    /**
     * @return bool
     */    
    public function getCarbonNeutral()
    {
        return $this->CarbonNeutral;
    }

    /**
     * @param bool $CarbonNeutral
     * @return ShipmentServiceOptions
     */
    public function setCarbonNeutral($CarbonNeutral)
    {
        $this->CarbonNeutral = $CarbonNeutral;
        return $this;
    }




    
}
