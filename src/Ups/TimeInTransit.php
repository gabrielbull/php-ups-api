<?php
namespace Ups;

use DOMDocument;
use SimpleXMLElement;
use Exception;
use Ups\Entity\TimeInTransitRequest;
use Ups\Entity\TimeInTransitResponse;

/**
 * TimeInTransit API Wrapper
 *
 * @package ups
 * @author Sebastien Vergnes <sebastien@vergnes.eu>
 */
class TimeInTransit extends Ups
{
    const ENDPOINT = '/TimeInTransit';

    /**
     * @param TimeInTransitRequest $shipment
     * @return TimeInTransitRequest
     * @throws Exception
     */
    public function getTimeInTransit(TimeInTransitRequest $shipment)
    {
        return $this->sendRequest($shipment);
    }

    /**
     * Creates and sends a request for the given shipment. This handles checking for
     * errors in the response back from UPS
     *
     * @param TimeInTransitRequest $timeInTransitRequest
     * @return TimeInTransitRequest
     * @throws Exception
     */
    private function sendRequest(TimeInTransitRequest $timeInTransitRequest)
    {
        $request = $this->createRequest($timeInTransitRequest);
        $response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl(self::ENDPOINT));

        if ($response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Create the TimeInTransit request
     *
     * @param TimeInTransitRequest $timeInTransitRequest The request details. Refer to the UPS documentation for available structure
     * @return string
     */
    private function createRequest(TimeInTransitRequest $timeInTransitRequest)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement("TimeInTransitRequest"));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement("Request"));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement("RequestAction", "TimeInTransit"));

        $transitFromNode = $trackRequest->appendChild($xml->createElement('TransitFrom'));
        $address = $timeInTransitRequest->getTransitFrom();
        if (isset($address)) {
            $transitFromNode->appendChild($address->toNode($xml));
        }

        $transitToNode = $trackRequest->appendChild($xml->createElement('TransitTo'));
        $address = $timeInTransitRequest->getTransitTo();
        if (isset($address)) {
            $transitToNode->appendChild($address->toNode($xml));
        }

        $weight = $timeInTransitRequest->getShipmentWeight();
        if (isset($weight)) {
            $trackRequest->appendChild($weight->toNode($xml));
        }

        $packages = $timeInTransitRequest->getTotalPackagesInShipment();
        if (isset($packages)) {
            $trackRequest->appendChild($xml->createElement("TotalPackagesInShipment", $packages));
        }

        $invoiceLineTotal = $timeInTransitRequest->getInvoiceLineTotal();
        if (isset($invoiceLineTotal)) {
            $trackRequest->appendChild($invoiceLineTotal->toNode($xml));
        }

        $pickupDate = $timeInTransitRequest->getPickupDate();
        if ($pickupDate) {
            $trackRequest->appendChild($xml->createElement("PickupDate", $pickupDate->format('Ymd')));
        }

        $indicator = $timeInTransitRequest->getDocumentsOnlyIndicator();
        if($indicator) {
            $trackRequest->appendChild($xml->createElement("DocumentsOnlyIndicator"));
        }

        return $xml->saveXML();
    }

    /**
     * Format the response
     *
     * @param SimpleXMLElement $response
     * @return TimeInTransitRequest
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        // We don't need to return data regarding the response to the user
        unset($response->Response);

        $result = $this->convertXmlObject($response);

        return new TimeInTransitResponse($result->TransitResponse);
    }
}