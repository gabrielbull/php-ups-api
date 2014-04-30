<?php

namespace UPS;

use DOMDocument,
    SimpleXMLElement,
    Exception;

/**
 * TimeInTransit API Wrapper
 *
 * @package ups
 * @author Sebastien Vergnes <sebastien@vergnes.eu>
 */
class TimeInTransit extends UPS
{
    private $trackingNumber;

    protected $endpoint = '/TimeInTransit';

    public function getTimeInTransit($shipment)
    {
        return $this->sendRequest($shipment);
    }

    /**
     * Creates and sends a request for the given shipment. This handles checking for
     * errors in the response back from UPS
     *
     * @param $shipment
     * @return stdClass
     * @throws \Exception
     */
    private function sendRequest($shipment)
    {
        $request = $this->createRequest($shipment);
        print_r ($request);
        $response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl($this->endpoint));

        if ($response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int) $response->Response->Error->ErrorCode
            );
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Create the TimeInTransit request
     *
     * @param stdClass $shipment The shipment details. Refer to the UPS documentation for available structure
     * @return  string
     */
    private function createRequest($shipment)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement("TimeInTransitRequest"));
        $trackRequest->setAttribute('xml:lang','en-US');

        $request = $trackRequest->appendChild($xml->createElement("Request"));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement("RequestAction", "TimeInTransit"));

        $transitFromNode = $trackRequest->appendChild($xml->createElement('TransitFrom'));
        if (isset($shipment->TransitFrom)) {
            Utilities::addAddressArtifactNode($shipment->TransitFrom, $transitFromNode);
        }

        $transitToNode = $trackRequest->appendChild($xml->createElement('TransitTo'));
        if (isset($shipment->TransitTo)) {
            Utilities::addAddressArtifactNode($shipment->TransitTo, $transitToNode);
        }

        $shipmentWeightNode = $trackRequest->appendChild($xml->createElement('ShipmentWeight'));
        if (isset($shipment->ShipmentWeight)) {
            $shipmentWeightNode->appendChild($xml->createElement("Weight", $shipment->ShipmentWeight->Weight));
            $uom = $shipmentWeightNode->appendChild($xml->createElement("UnitOfMeasurement"));
            $uom->appendChild($xml->createElement("Code", $shipment->ShipmentWeight->UnitOfMeasurement->Code));
            $uom->appendChild($xml->createElement("Description", $shipment->ShipmentWeight->UnitOfMeasurement->Description));
        }

        if (isset($shipment->TotalPackagesInShipment)) {
            $trackRequest->appendChild($xml->createElement("TotalPackagesInShipment", $shipment->TotalPackagesInShipment));
        }

        $invoiceLineTotalNode = $trackRequest->appendChild($xml->createElement('InvoiceLineTotal'));
        if (isset($shipment->InvoiceLineTotal)) {
            $invoiceLineTotalNode->appendChild($xml->createElement("CurrencyCode", $shipment->InvoiceLineTotal->CurrencyCode));
            $invoiceLineTotalNode->appendChild($xml->createElement("MonetaryValue", $shipment->InvoiceLineTotal->MonetaryValue));
        }

        if (isset($shipment->PickupDate)) {
            $trackRequest->appendChild($xml->createElement("PickupDate", $shipment->PickupDate));
        }

        $trackRequest->appendChild($xml->createElement("DocumentsOnlyIndicator"));


        return $xml->saveXML();
    }

    /**
     * Format the response
     *
     * @param   SimpleXMLElement    $response
     * @return  stdClass
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        // We don't need to return data regarding the response to the user
        unset($response->Response);

        return $this->convertXmlObject($response);
    }
}