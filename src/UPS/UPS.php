<?php

namespace ups;

use DOMDocument,
    SimpleXMLElement,
    Exception;

/**
 * UPS class
 *
 * @package ups
 */
abstract class Ups {
	protected $accessKey, $userId, $password;
	
	/**
	 * Constructor
	 *
	 * @param   string  $accessKey  UPS License Access Key
	 * @param   string  $userId     UPS User ID
	 * @param   string  $password   UPS User Password
	 */
	public function __construct($accessKey, $userId, $password) {
		$this->accessKey = $accessKey;
		$this->userId = $userId;
		$this->password = $password;
	}
	
	/**
	 * Format a Unix timestamp or a date time with a Y-m-d H:i:s format into a YYYYMMDDHHmmss format required by UPS.
	 *
	 * @param   string
	 * @return  string
	 */
	protected function formatDateTime($timestamp) {
		if (!is_numeric($timestamp)) $timestamp = strtotime($timestamp);		
		return date('YmdHis', $timestamp);
	}
	
	/**
	 * Create the access request
	 * 
	 * @return  string
	 */
	protected function createAccess() {
		$xml = new DOMDocument();
		$xml->formatOutput = true;

		// Create the AccessRequest element
		$accessRequest = $xml->appendChild($xml->createElement("AccessRequest"));
		$accessRequest->setAttribute('xml:lang','en-US');
        
        $accessRequest->appendChild($xml->createElement("AccessLicenseNumber", $this->accessKey));
        $accessRequest->appendChild($xml->createElement("UserId", $this->userId));
        $accessRequest->appendChild($xml->createElement("Password", $this->password));
        
		return $xml->saveXML();
	}

	/**
	 * Send request to UPS
	 * 
	 * @param   string  $access         The access request xml
	 * @param   string  $request	    The request xml
	 * @param   string  $endpointurl	The UPS API Endpoint URL
	 * @return  SimpleXMLElement
	 */
	protected function request($access, $request, $endpointurl) {
		//create Post request
		$form = [
			'http' => [
				'method' => 'POST',
				'header' => 'Content-type: application/x-www-form-urlencoded',
				'content' => $access . $request
			]
		];
				
		$request = stream_context_create($form);

		if(!$handle = fopen($endpointurl, 'rb', false, $request)) {
			throw new Exception("Failure: Connection to Endpoint URL failed.");
		}
		
		$response = stream_get_contents($handle);
		fclose($handle);

		if($response != false) {
			$response = new SimpleXMLElement($response);
			
			if (isset($response->Response->ResponseStatusCode)) {
				return $response;
			}
		}
		
		throw new Exception("Failure: Response is invalid.");
	}
}
