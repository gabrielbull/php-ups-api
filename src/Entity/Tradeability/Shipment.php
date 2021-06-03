<?php

namespace Ups\Entity\Tradeability;

use DomDocument;
use DomElement;
use Ups\NodeInterface;

class Shipment implements NodeInterface
{
    const TRANSPORT_MODE_AIR = 1;
    const TRANSPORT_MODE_GROUND = 2;
    const TRANSPORT_MODE_RAIL = 3;
    const TRANSPORT_MODE_OCEAN = 4;

    /**
     * @var string
     */
    private $originCountryCode;

    /**
     * @var string
     */
    private $originStateProvinceCode;

    /**
     * @var string
     */
    private $destinationCountryCode;

    /**
     * @var string
     */
    private $destinationStateProvinceCode;

    /**
     * @var int
     */
    private $transportationMode;

    /**
     * @var FreightCharges
     */
    private $freightCharges;

    /**
     * @var mixed
     */
    private $additionalInsurance;

    /**
     * @var array
     */
    private $products = [];

    /**
     * @var string
     */
    private $resultCurrencyCode;

    /**
     * @var
     */
    private $transactionReferenceId;

    /**
     * @var int
     */
    private $tariffCodeAlert;

    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Shipment');

        if ($this->getFreightCharges() instanceof FreightCharges) {
            $node->appendChild($this->getFreightCharges()->toNode($document));
        }

        // Then the required values
        $node->appendChild($document->createElement('OriginCountryCode', $this->getOriginCountryCode()));
        $node->appendChild($document->createElement('DestinationCountryCode', $this->getDestinationCountryCode()));

        // Then the optional values
        if ($this->getOriginStateProvinceCode() !== null) {
            $node->appendChild(
                $document->createElement(
                    'OriginStateProvinceCode',
                    $this->getOriginStateProvinceCode()
                )
            );
        }
        if ($this->getDestinationStateProvinceCode() !== null) {
            $node->appendChild(
                $document->createElement(
                    'DestinationStateProvinceCode',
                    $this->getDestinationStateProvinceCode()
                )
            );
        }
        if ($this->getTransportationMode() !== null) {
            $node->appendChild($document->createElement('TransportationMode', $this->getTransportationMode()));
        }
        if ($this->getResultCurrencyCode() !== null) {
            $node->appendChild($document->createElement('ResultCurrencyCode', $this->getResultCurrencyCode()));
        }
        if ($this->getTariffCodeAlert() !== null) {
            $node->appendChild($document->createElement('TariffCodeAlert', $this->getTariffCodeAlert()));
        }
        if ($this->getTransactionReferenceId() !== null) {
            $node->appendChild($document->createElement('TransactionReferenceID', $this->getTransactionReferenceId()));
        }

        // Then products array
        foreach ($this->products as $product) {
            $node->appendChild($product->toNode($document));
        }

        // Return created node
        return $node;
    }

    /**
     * @return mixed
     */
    public function getAdditionalInsurance()
    {
        return $this->additionalInsurance;
    }

    /**
     * @param mixed $additionalInsurance
     * @return Shipment
     */
    public function setAdditionalInsurance($additionalInsurance)
    {
        $this->additionalInsurance = $additionalInsurance;

        return $this;
    }

    /**
     * @return FreightCharges
     */
    public function getFreightCharges()
    {
        return $this->freightCharges;
    }

    /**
     * @param FreightCharges $freightCharges
     * @return Shipment
     */
    public function setFreightCharges($freightCharges)
    {
        $this->freightCharges = $freightCharges;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginCountryCode()
    {
        return $this->originCountryCode;
    }

    /**
     * @param string $originCountryCode
     * @return Shipment
     */
    public function setOriginCountryCode($originCountryCode)
    {
        $this->originCountryCode = $originCountryCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationCountryCode()
    {
        return $this->destinationCountryCode;
    }

    /**
     * @param string $destinationCountryCode
     * @return Shipment
     */
    public function setDestinationCountryCode($destinationCountryCode)
    {
        $this->destinationCountryCode = $destinationCountryCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginStateProvinceCode()
    {
        return $this->originStateProvinceCode;
    }

    /**
     * @param string $originStateProvinceCode
     * @return Shipment
     */
    public function setOriginStateProvinceCode($originStateProvinceCode)
    {
        $this->originStateProvinceCode = $originStateProvinceCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationStateProvinceCode()
    {
        return $this->destinationStateProvinceCode;
    }

    /**
     * @param string $destinationStateProvinceCode
     * @return Shipment
     */
    public function setDestinationStateProvinceCode($destinationStateProvinceCode)
    {
        $this->destinationStateProvinceCode = $destinationStateProvinceCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getTransportationMode()
    {
        return $this->transportationMode;
    }

    /**
     * @param int $transportationMode
     * @return Shipment
     */
    public function setTransportationMode($transportationMode)
    {
        $this->transportationMode = $transportationMode;

        return $this;
    }

    /**
     * @return string
     */
    public function getResultCurrencyCode()
    {
        return $this->resultCurrencyCode;
    }

    /**
     * @param string $resultCurrencyCode
     * @return Shipment
     */
    public function setResultCurrencyCode($resultCurrencyCode)
    {
        $this->resultCurrencyCode = $resultCurrencyCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getTariffCodeAlert()
    {
        return $this->tariffCodeAlert;
    }

    /**
     * @param int $tariffCodeAlert
     * @return Shipment
     */
    public function setTariffCodeAlert($tariffCodeAlert)
    {
        $this->tariffCodeAlert = $tariffCodeAlert;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionReferenceId()
    {
        return $this->transactionReferenceId;
    }

    /**
     * @param mixed $transactionReferenceId
     * @return Shipment
     */
    public function setTransactionReferenceId($transactionReferenceId)
    {
        $this->transactionReferenceId = $transactionReferenceId;

        return $this;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return Shipment
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param Product $product
     * @return Shipment
     */
    public function addProduct(Product $product)
    {
        array_push($this->products, $product);

        return $this;
    }
}
