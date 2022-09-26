<?php declare(strict_types=1);

namespace Ups\Entity\RatingServiceSelectionRequest;

/**
 * Class Request
 * For RequestOption Rate is the only valid request option for UPS Ground Freight Pricing requests. But it all depends on the purpose of use.
 *
 * @param string $requestOption The request option: Rate, Shop, or Ratetimeintransit
 * Rate =           The server rates (The default Request option is Rate if a Request Option is not provided).
 * Shop =           The server validates the shipment, and returns rates for all UPS products from the ShipFrom to the ShipTo addresses.
 * Ratetimeintransit = The server rates with transit time information
 * Shoptimeintransit = The server validates the shipment, and returns rates and transit times for all UPS products from the ShipFrom to the ShipTo addresses.
 *
 */
class Request
{
    public const REQUEST_OPTION_RATE = 'Rate';
    public const REQUEST_OPTION_SHOP = 'Shop';
    public const REQUEST_OPTION_RATETIMEINTRANSIT = 'Ratetimeintransit';
    public const REQUEST_OPTION_SHOPTIMEINTRANSIT = 'Shoptimeintransit';

    private string $transactionReference;
    private string $requestAction;
    private string $requestOption;

    public function __construct(
        string $transactionReference = '',
        string $requestAction = self::REQUEST_OPTION_RATE,
        string $requestOption = self::REQUEST_OPTION_RATE
    ) {
        $this->transactionReference = $transactionReference;
        $this->requestAction = $requestAction;
        $this->requestOption = $requestOption;
    }


    /**
     * @throws \DOMException
     */
    public function toNode(\DOMDocument $document = null): \DOMElement
    {
        if (null === $document) {
            $document = new \DOMDocument();
        }

        $node = $document->createElement('Request');

        if ($this->getTransactionReference()) {
            $node->appendChild($document->createElement('TransactionReference', $this->getTransactionReference()));
        }

        if ($this->getRequestAction()) {
            $node->appendChild($document->createElement('RequestAction', $this->getRequestAction()));
        }

        if ($this->getRequestOption()) {
            $node->appendChild($document->createElement('RequestOption', $this->getRequestOption()));
        }

        return $node;
    }

    public function getRequestOption(): string
    {
        return $this->requestOption;
    }

    public function setRequestOption(string $requestOption): void
    {
        $this->requestOption = $requestOption;
    }

    public function getRequestAction(): string
    {
        return $this->requestAction;
    }

    public function setRequestAction(string $requestAction): void
    {
        $this->requestAction = $requestAction;
    }

    public function getTransactionReference(): string
    {
        return $this->transactionReference;
    }

    public function setTransactionReference(string $transactionReference): void
    {
        $this->transactionReference = $transactionReference;
    }
}
