<?php

namespace UPS;

use DOMDocument,
    SimpleXMLElement,
    Exception;

/**
 * Rate API Wrapper
 *
 * @package ups
 * @author Michael Williams <michael.williams@limelyte.com>
 */
class Rate extends UPS
{
	private $trackingNumber;
    private $requestOption;

	protected $endpoint = '/Rate';

    public function shopRates($shipment)
    {
        $this->requestOption = "Shop";

        $request = $this->createRequest($shipment);
        $response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl($this->endpoint));

        return $this->formatResponse($response);
    }

    public function getRate()
    {
        $this->requestOption = "Rate";

    }

	/**
	 * Create the Rate request
	 *
     * @param stdClass $shipment The shipment details. Refer to the UPS documentation for available structure
	 * @return  string
	 */
    private function createRequest($shipment)
    {
		$xml = new DOMDocument();
		$xml->formatOutput = true;

		$trackRequest = $xml->appendChild($xml->createElement("RatingServiceSelectionRequest"));
		$trackRequest->setAttribute('xml:lang','en-US');

		$request = $trackRequest->appendChild($xml->createElement("Request"));

		$node = $xml->importNode($this->createTransactionNode(), true);
		$request->appendChild($node);

		$request->appendChild($xml->createElement("RequestAction", "Rate"));
        $request->appendChild($xml->createElement("RequestOption", $this->requestOption));

        $shipmentNode = $trackRequest->appendChild($xml->createElement('Shipment'));

        if (isset($shipment->Shipper)) {
            $shipper = $shipmentNode->appendChild($xml->createElement("Shipper"));

            if (isset($shipment->Shipper->ShipperNumber)) {
                $shipper->appendChild($xml->createElement("ShipperNumber", $shipment->Shipper->ShipperNumber));
            }

            if (isset($shipment->Shipper->Address)) {
                Utilities::addAddressNode($shipment->Shipper->Address, $shipper);
            }
        }

        if (isset($shipment->ShipFrom)) {
            $shipFrom = $shipmentNode->appendChild($xml->createElement("ShipFrom"));
            Utilities::addLocationInformation($shipment->ShipFrom, $shipFrom);
        }

        if (isset($shipment->ShipTo)) {
            $shipTo = $shipmentNode->appendChild($xml->createElement("ShipTo"));
            Utilities::addLocationInformation($shipment->ShipTo, $shipTo);
        }

        Utilities::addPackages($shipment, $shipmentNode);

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