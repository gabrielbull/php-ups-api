<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class RateInformation implements NodeInterface
{
    private string $negotiatedRatesIndicator;

    private string $rateChartIndicator;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        $this->setNegotiatedRatesIndicator(false);
        $this->setRateChartIndicator(false);

        if (null !== $attributes) {
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
     *
     * @return DOMElement
     * @throws \DOMException
     */
    public function toNode(DOMDocument $document = null): DOMElement
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('RateInformation');

        if ($this->getNegotiatedRatesIndicator()) {
            $node->appendChild($document->createElement('NegotiatedRatesIndicator', $this->getNegotiatedRatesIndicator()));
        }

        if ($this->getRateChartIndicator()) {
            $node->appendChild($document->createElement('RateChartIndicator', $this->getRateChartIndicator()));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getNegotiatedRatesIndicator(): string
    {
        return $this->negotiatedRatesIndicator;
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setNegotiatedRatesIndicator(string $value): void
    {
        $this->negotiatedRatesIndicator = $value;
    }

    /**
     * @return string
     */
    public function getRateChartIndicator(): string
    {
        return $this->rateChartIndicator;
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setRateChartIndicator(string $value): void
    {
        $this->rateChartIndicator = $value;
    }
}
