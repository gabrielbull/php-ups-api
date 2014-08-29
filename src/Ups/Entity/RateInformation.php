<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class RateInformation implements NodeInterface
{

    /** @var boolean */
    private $negotiatedRatesIndicator;

    /** @var boolean */
    private $rateChartIndicator;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        $this->setNegotiatedRatesIndicator(false);
        $this->setRateChartIndicator(false);

        if (null != $attributes) {
            if (isset($attributes->NegotiatedRatesIndicator)) {
                $this->setNegotiatedRatesIndicator(true);
            }
            if (isset($attributes->RateChartIndicator)) {
                $this->setRateChartIndicator(true);
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

        $node = $document->createElement('RateInformation');

        if ($this->getNegotiatedRatesIndicator()) {
            $node->appendChild($document->createElement('NegotiatedRatesIndicator'));
        }

        if ($this->getRateChartIndicator()) {
            $node->appendChild($document->createElement('RateChartIndicator'));
        }

        return $node;
    }

    /**
     * @return boolean
     */
    public function getNegotiatedRatesIndicator()
    {
        return $this->negotiatedRatesIndicator;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setNegotiatedRatesIndicator($value)
    {
        $this->negotiatedRatesIndicator = $value;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRateChartIndicator()
    {
        return $this->rateChartIndicator;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setRateChartIndicator($value)
    {
        $this->rateChartIndicator = $value;
        return $this;
    }

}