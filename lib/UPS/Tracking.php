<?php

namespace UPS;

use DOMDocument,
    SimpleXMLElement,
    Exception;

/**
 * Tracking API Wrapper
 *
 * @package ups
 */
class Tracking extends UPS {
	private $trackingNumber, $requestOption;
	
	protected $endpoint = '/Track';
	
	/**
	 * Get a QuantumView subscription
	 * 
	 * @param   string  $trackingNumber The package’s tracking number.
	 * @param   string  $requestOption  Optional processing. For Mail Innovations the only valid options are Last Activity and All activity.
	 * @return  stdClass
	 */
	public function track($trackingNumber, $requestOption = 'activity') {		
		$this->trackingNumber = $trackingNumber;
		$this->requestOption = $requestOption;
		
		// Create request
		$access = $this->createAccess();
		$request = $this->createRequest();
				
		$response = $this->request($access, $request, $this->compileEndpointUrl());
		
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
	 * Create the QuantumView request
	 * 
	 * @return  string
	 */
	private function createRequest() {
		$xml = new DOMDocument();
		$xml->formatOutput = true;

		// Create the QuantumViewRequest element
		$trackRequest = $xml->appendChild($xml->createElement("TrackRequest"));
		$trackRequest->setAttribute('xml:lang','en-US');
		
		// Create the Request element
		$request = $trackRequest->appendChild($xml->createElement("Request"));
		$request->appendChild($xml->createElement("RequestAction", "Track"));
		
		if (null !== $this->requestOption) {
			$request->appendChild($xml->createElement("RequestOption", $this->requestOption));
		}
		
		// Add tracking number
		if (null !== $this->trackingNumber) {
			$trackRequest->appendChild($xml->createElement("TrackingNumber", $this->trackingNumber));
		}
        
		return $xml->saveXML();
	}
		
	/**
	 * Fromat the response
	 * 
	 * @param   SimpleXMLElement
	 * @return  stdClass
	 */
	private function formatResponse(SimpleXMLElement $response) {
		return $this->convertXmlObject($response->Shipment);
	}
}