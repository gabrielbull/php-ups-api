<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

// @todo Refactor to private properties
class ShipmentServiceOptions implements NodeInterface
{
    /**
     * @var
     */
    public $SaturdayPickup;

    /**
     * @var
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
     * @var
     */
    public $NegotiatedRatesIndicator;

    /**
     * @var
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
     * @var null|LabelMethod
     */
    private $labelMethod;

    /**
     * @var null|LabelDelivery
     */
    private $labelDelivery;

    /**
     * @var array
     */
    private $notifications = [];

    /**
     * @var AccessPointCOD
     */
    private $accessPointCOD;

    /**
     * @var boolean
     */
    private $importControlIndicator;

    /**
     * @var DeliveryConfirmation
     */
    private $deliveryConfirmation;

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
                $accessCode = new AccessPointCOD();
                $accessCode->setCurrencyCode($response->AccessPointCOD->currencyCode);
                $accessCode->setMonetaryValue($response->AccessPointCOD->monetaryValue);
                $this->setAccessPointCOD($accessCode);
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
            if (isset($response->ImportControlIndicator)) {
                $this->setImportControlIndicator($response->ImportControlIndicator);
            }
            if (isset($response->DeliveryConfirmation)) {
                $this->setDeliveryConfirmation($response->DeliveryConfirmation);
            }
            if (isset($response->LabelMethod)) {
                $this->setLabelMethod(new LabelMethod($response->LabelMethod));
            }
            // TODO: check if email message is still in XML.
            /* if (isset($response->EMailMessage)) {
                $this->setEMailMessage(new EMailMessage($response->EMailMessage));
            } */
        }
    }

    public function toNode(?DOMDocument $document = null): DOMElement
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ShipmentServiceOptions');

        if (isset($this->DirectDeliveryOnlyIndicator)) {
            $node->appendChild($document->createElement('DirectDeliveryOnlyIndicator'));
        }

        if (isset($this->DeliverToAddresseeOnlyIndicator)) {
            $node->appendChild($document->createElement('DeliverToAddresseeOnlyIndicator'));
        }

        if (isset($this->SaturdayPickup)) {
            $node->appendChild($document->createElement('SaturdayPickup'));
        }

        if (isset($this->SaturdayDelivery)) {
            $node->appendChild($document->createElement('SaturdayDelivery'));
        }

        if ($this->getCOD()) {
            $node->appendChild($this->getCOD()->toNode($document));
        }

        if ($this->getAccessPointCOD()) {
            $node->appendChild($this->getAccessPointCOD()->toNode($document));
        }

        if (isset($this->internationalForms)) {
            $node->appendChild($this->internationalForms->toNode($document));
        }

        if (isset($this->deliveryConfirmation)) {
            $node->appendChild($this->deliveryConfirmation->toNode($document));
        }

        if (isset($this->importControlIndicator)) {
            $node->appendChild($document->createElement('ImportControlIndicator'));
        }

        if (isset($this->labelMethod)) {
            $node->appendChild($this->labelMethod->toNode($document));
        }

        if (isset($this->labelDelivery)) {
            $labelDeliveryNode = $node->appendChild($document->createElement('LabelDelivery'));
            $emailMessageNode = $labelDeliveryNode->appendChild($document->createElement('EMailMessage'));
            $labelDelivery = $this->getLabelDelivery();
            foreach ($labelDelivery as $key => $value) {
                if ($key === 'LabelLinkIndicator') {
                    $labelDeliveryNode->appendChild($document->createElement($key, $value));
                } elseif ($key === 'SubjectCode') {
                    $SubjectNode = $emailMessageNode->appendChild($document->createElement('Subject'));
                    $SubjectNode->appendChild($document->createElement($key, $value));
                } else {
                    $emailMessageNode->appendChild($document->createElement($key, $value));
                }
            }
        }

        if (!empty($this->notifications)) {
            foreach ($this->notifications as $notification) {
                $node->appendChild($notification->toNode($document));
            }
        }

        return $node;
    }

    public function getAccessPointCOD(): ?AccessPointCOD
    {
        return $this->accessPointCOD;
    }

    public function setAccessPointCOD(AccessPointCOD $accessPointCOD): self
    {
        $this->accessPointCOD = $accessPointCOD;

        return $this;
    }

    public function setInternationalForms(InternationalForms $data): self
    {
        $this->internationalForms = $data;

        return $this;
    }

    public function getInternationalForms(): InternationalForms
    {
        return $this->internationalForms;
    }

    public function setLabelMethod(LabelMethod $data): self
    {
        $this->labelMethod = $data;

        return $this;
    }

    public function getLabelMethod(): ?LabelMethod
    {
        return $this->labelMethod;
    }

    public function setLabelDelivery(LabelDelivery $data): self
    {
        $this->labelDelivery = $data;

        return $this;
    }

    public function getLabelDelivery(): ?LabelDelivery
    {
        return $this->labelDelivery;
    }

    public function addNotification(Notification $notification): self
    {
        $this->notifications[] = $notification;

        if (count($this->notifications) > 3) {
            throw new \Exception('Maximum 3 notifications allowed');
        }

        return $this;
    }

    public function getNotifications(): array
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
     */
    public function setSaturdayPickup($SaturdayPickup): self
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
     */
    public function setSaturdayDelivery($SaturdayDelivery): self
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
     */
    public function setCOD($COD): self
    {
        $this->COD = $COD;

        return $this;
    }

    public function getCallTagARS(): CallTagARS
    {
        return $this->CallTagARS;
    }

    public function setCallTagARS(CallTagARS $CallTagARS): self
    {
        $this->CallTagARS = $CallTagARS;

        return $this;
    }

    public function isNegotiatedRatesIndicator(): bool
    {
        return $this->NegotiatedRatesIndicator;
    }

    public function setNegotiatedRatesIndicator(bool $NegotiatedRatesIndicator): self
    {
        $this->NegotiatedRatesIndicator = $NegotiatedRatesIndicator;

        return $this;
    }

    public function isImportControlIndicator(): bool
    {
        return $this->importControlIndicator;
    }

    public function setImportControlIndicator(bool $importControlIndicator): self
    {
        $this->importControlIndicator = $importControlIndicator;

        return $this;
    }

    public function setDeliveryConfirmation(DeliveryConfirmation $deliveryConfirmation): self
    {
        $this->deliveryConfirmation = $deliveryConfirmation;

        return $this;
    }

    public function getDeliveryConfirmation(): ?DeliveryConfirmation
    {
        return $this->deliveryConfirmation;
    }

    public function isDirectDeliveryOnlyIndicator(): bool
    {
        return $this->DirectDeliveryOnlyIndicator;
    }

    public function setDirectDeliveryOnlyIndicator(bool $DirectDeliveryOnlyIndicator): self
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
    public function setDeliverToAddresseeOnlyIndicator($DeliverToAddresseeOnlyIndicator): self
    {
        $this->DeliverToAddresseeOnlyIndicator = $DeliverToAddresseeOnlyIndicator;

        return $this;
    }
}
