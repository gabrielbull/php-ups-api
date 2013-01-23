<?php

namespace ups;

use DOMDocument;

/**
 * Tracking API Wrapper
 *
 * @package ups
 */
class Tracking extends Ups {
	private $trackingNumber, $requestOption;
	
	private $endpointurl = 'https://onlinetools.ups.com/ups.app/xml/Track';
	
	public $response;
	
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
				
		$this->response = $this->request($access, $request, $this->endpointurl);
		
		if ($this->response->Response->ResponseStatusCode == 0) {
			throw new Exception(
				"Failure ({$this->response->Response->Error->ErrorSeverity}): {$this->response->Response->Error->ErrorDescription}", 
				(int) $this->response->Response->Error->ErrorCode
			);
		} else {
			return $this->formatResponse();
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
	 * @return  stdClass
	 */
	private function formatResponse() {
		return $this->convertXmlObject($this->response->Shipment);
	}
}
