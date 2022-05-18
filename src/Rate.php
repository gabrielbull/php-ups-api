<?php declare(strict_types=1);

namespace Ups;

use DOMDocument;
use DOMElement;
use Exception;
use SimpleXMLElement;
use Ups\Entity\RateRequest;
use Ups\Entity\RateResponse;
use Ups\Entity\RatingServiceSelectionRequest\Request as RequestOption;
use Ups\Entity\Shipment;

/**
 * Rate API Wrapper.
 *
 * @author Michael Williams <michael.williams@limelyte.com>
 */
class Rate extends Ups
{
    const ENDPOINT = '/Rate';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     *                        todo: make private
     */
    public $response;

    protected string $requestOption;

    /**
     * @throws Exception
     */
    public function shopRates($rateRequest, string $requestOption = RequestOption::REQUEST_OPTION_RATE): RateResponse
    {
        if ($rateRequest instanceof Shipment) {
            $shipment = $rateRequest;
            $rateRequest = new RateRequest();
            $rateRequest->setShipment($shipment);
        }

        $this->setRequestOption($requestOption);

        return $this->sendRequest($rateRequest);
    }

    /**
     * Rate is the only valid request option for UPS Ground Freight Pricing requests. But it all depends on the purpose of use.
     *
     * @param string $requestOption The request option: Rate, Shop, or Ratetimeintransit
     * Rate =           The server rates (The default Request option is Rate if a Request Option is not provided).
     * Shop =           The server validates the shipment, and returns rates for all UPS products from the ShipFrom to the ShipTo addresses.
     * Ratetimeintransit = The server rates with transit time information
     * Shoptimeintransit = The server validates the shipment, and returns rates and transit times for all UPS products from the ShipFrom to the ShipTo addresses.
     *
     * @return void
     */
    public function setRequestOption(string $requestOption): void
    {
        $this->requestOption = $requestOption;
    }


    /**
     * @throws Exception
     */
    public function getRate($rateRequest, string $requestOption = RequestOption::REQUEST_OPTION_RATE): RateResponse
    {
        if ($rateRequest instanceof Shipment) {
            $shipment = $rateRequest;
            $rateRequest = new RateRequest();
            $rateRequest->setShipment($shipment);
        }

        $this->setRequestOption($requestOption);

        return $this->sendRequest($rateRequest);
    }


    /**
     * Creates and sends a request for the given shipment. This handles checking for
     * errors in the response back from UPS.
     *
     * @param RateRequest $rateRequest
     *
     * @return RateResponse
     * @throws Exception
     *
     */
    protected function sendRequest(RateRequest $rateRequest): RateResponse
    {
        $request = $this->createRequest($rateRequest);

        $this->response = $this->getRequest()->request($this->createAccess(), $request, $this->compileEndpointUrl(self::ENDPOINT));
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new \RuntimeException('Failure (0): Unknown error', 0);
        }

        if ($response->Response->ResponseStatusCode == 0) {
            throw new \RuntimeException(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int) $response->Response->Error->ErrorCode
            );
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Create the Rate request.
     *
     * @param RateRequest $rateRequest The request details. Refer to the UPS documentation for available structure
     *
     * @return string
     * @throws \DOMException
     */
    private function createRequest(RateRequest $rateRequest): string
    {
        $shipment = $rateRequest->getShipment();

        $document = $xml = new DOMDocument();
        $xml->formatOutput = true;

        /** @var DOMElement $trackRequest */
        $trackRequest = $xml->appendChild($xml->createElement('RatingServiceSelectionRequest'));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'Rate'));
        $request->appendChild($xml->createElement('RequestOption', $this->requestOption));

        $trackRequest->appendChild($rateRequest->getPickupType()->toNode($document));

        $customerClassification = $rateRequest->getCustomerClassification();
        if (isset($customerClassification)) {
            $trackRequest->appendChild($customerClassification->toNode($document));
        }

        $shipmentNode = $trackRequest->appendChild($xml->createElement('Shipment'));

        // Support specifying an individual service
        $service = $shipment->getService();
        if (isset($service)) {
            $shipmentNode->appendChild($service->toNode($document));
        }

        $shipper = $shipment->getShipper();
        if (isset($shipper)) {
            $shipmentNode->appendChild($shipper->toNode($document));
        }

        $shipFrom = $shipment->getShipFrom();
        if (isset($shipFrom)) {
            $shipmentNode->appendChild($shipFrom->toNode($document));
        }

        $shipTo = $shipment->getShipTo();
        if (isset($shipTo)) {
            $shipmentNode->appendChild($shipTo->toNode($document));
        }

        $alternateDeliveryAddress = $shipment->getAlternateDeliveryAddress();
        if (isset($alternateDeliveryAddress)) {
            $shipmentNode->appendChild($alternateDeliveryAddress->toNode($document));
        }

        $rateInformation = $shipment->getRateInformation();
        if ($rateInformation !== null) {
            $shipmentNode->appendChild($rateInformation->toNode($document));
        }

        $shipmentIndicationType = $shipment->getShipmentIndicationType();
        if (isset($shipmentIndicationType)) {
            $shipmentNode->appendChild($shipmentIndicationType->toNode($document));
        }

        foreach ($shipment->getPackages() as $package) {
            $shipmentNode->appendChild($package->toNode($document));
        }

        $shipmentServiceOptions = $shipment->getShipmentServiceOptions();
        if (isset($shipmentServiceOptions)) {
            $shipmentNode->appendChild($shipmentServiceOptions->toNode($xml));
        }

        $deliveryTimeInformation = $shipment->getDeliveryTimeInformation();
        if (isset($deliveryTimeInformation)) {
            $shipmentNode->appendChild($deliveryTimeInformation->toNode($xml));
        }

        $ShipmentTotalWeight = $shipment->getShipmentTotalWeight();
        if (isset($ShipmentTotalWeight)) {
            $shipmentNode->appendChild($ShipmentTotalWeight->toNode($xml));
        }

        $InvoiceLineTotal = $shipment->getInvoiceLineTotal();
        if (isset($InvoiceLineTotal)) {
            $shipmentNode->appendChild($InvoiceLineTotal->toNode($xml));
        }

        if ($shipment->getTaxInformationIndicator()) {
            $shipmentNode->appendChild($xml->createElement('TaxInformationIndicator'));
        }

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return RateResponse
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        // We don't need to return data regarding the response to the user
        unset($response->Response);

        $result = $this->convertXmlObject($response);

        return new RateResponse($result);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        if (null === $this->request) {
            $this->request = new Request($this->logger);
        }

        return $this->request;
    }

    /**
     * @param RequestInterface $request
     *
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;

        return $this;
    }
}
