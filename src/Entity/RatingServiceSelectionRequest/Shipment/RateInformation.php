<?php declare(strict_types=1);

namespace Ups\Entity\RateRequest\Shipment;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class RateInformation implements NodeInterface
{
    private bool $negotiatedRatesIndicator;

    private bool $rateChartIndicator;

    public function __construct(?object $attributes = null)
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
            $node->appendChild($document->createElement('NegotiatedRatesIndicator', 'true'));
        }

        if ($this->getRateChartIndicator()) {
            $node->appendChild($document->createElement('RateChartIndicator'));
        }

        return $node;
    }

    public function getNegotiatedRatesIndicator(): bool
    {
        return $this->negotiatedRatesIndicator;
    }

    public function setNegotiatedRatesIndicator(bool $value): void
    {
        $this->negotiatedRatesIndicator = $value;
    }

    public function getRateChartIndicator(): bool
    {
        return $this->rateChartIndicator;
    }

    public function setRateChartIndicator(bool $value): void
    {
        $this->rateChartIndicator = $value;
    }
}
