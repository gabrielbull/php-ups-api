<?php

namespace ups;

use DOMDocument,
    Exception,
    SimpleXMLElement,
    ArrayObject;

/**
 * QuantumView Wrapper
 *
 * @package ups
 */
class QuantumView extends Ups {
	private $name, $beginDateTime, $endDateTime, $fileName, $bookmark;
	
	private $endpointurl = 'https://onlinetools.ups.com/ups.app/xml/QVEvents';
	
	private $responseBookmark;
	
	public $response;
	
	/**
	 * Get a QuantumView subscription
	 * 
	 * @param   string  $name           Name of subscription requested by user.
	 * @param   string  $beginDateTime  Beginning date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
	 * @param   string  $endDateTime    Ending date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
	 * @param   string  $fileName       File name of specific subscription requested by user.
	 * @param   string  $bookmark       Bookmarks the file for next retrieval.
	 * @return  ArrayObject
	 */
	public function getSubscription($name = null, $beginDateTime = null, $endDateTime = null, $fileName = null, $bookmark = null) {
		// Format date times
		if (null !== $beginDateTime) $beginDateTime = $this->formatDateTime($beginDateTime);
		if (null !== $endDateTime) $endDateTime = $this->formatDateTime($endDateTime);
		
		// If user provided a begin date time but no end date time, we assume the end date time is now
		if (null !== $beginDateTime && null === $endDateTime) $endDateTime = date('YmdHis');
		
		$this->name = $name;
		$this->beginDateTime = $beginDateTime;
		$this->endDateTime = $endDateTime;
		$this->fileName = $fileName;
		$this->bookmark = $bookmark;
		
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
			if (isset($this->response->Bookmark)) {
				$this->responseBookmark = $this->response->Bookmark;
			}
			
			return $this->formatResponse();
		}
	}
	
	/**
	 * Return true if request has a bookmark
	 * 
	 * @return  bool
	 */
	public function hasBookmark() {
		if (null !== $this->responseBookmark) return true;
		else return false;
	}
	
	/**
	 * Return true if request has a bookmark
	 * 
	 * @return  bool
	 */
	public function getBookmark() {
		return $this->responseBookmark;
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
		$quantumViewRequest = $xml->appendChild($xml->createElement("QuantumViewRequest"));
		$quantumViewRequest->setAttribute('xml:lang','en-US');
        
		// Create the SubscriptionRequest element
		if (null !== $this->name || null !== $this->beginDateTime || null !== $this->fileName) {
			$subscriptionRequest = $quantumViewRequest->appendChild($xml->createElement("SubscriptionRequest"));
			
			// Subscription name
			if(null !== $this->name) {
				$subscriptionRequest->appendChild($xml->createElement("Name", $this->name));
			}
			
			// Date Time Range
			if (null !== $this->beginDateTime) {
				$dateTimeRange = $subscriptionRequest->appendChild($xml->createElement("DateTimeRange"));
				$dateTimeRange->appendChild($xml->createElement("BeginDateTime", $this->beginDateTime));
				$dateTimeRange->appendChild($xml->createElement("EndDateTime", $this->endDateTime));
			
			// File name
			} else if(null !== $this->fileName) {
				$subscriptionRequest->appendChild($xml->createElement("FileName", $this->fileName));
			}
		}
		
		// Create the Bookmark element
		if (null !== $this->bookmark) {
			$quantumViewRequest->appendChild($xml->createElement("Bookmark", $this->bookmark));
		}
		
		// Create the Request element
		$request = $quantumViewRequest->appendChild($xml->createElement("Request"));
		$request->appendChild($xml->createElement("RequestAction", "QVEvents"));
        
		return $xml->saveXML();
	}
	
	/**
	 * Fromat the response
	 * 
	 * @return  string
	 */
	private function formatResponse() {
		$eventsException = ['FileName', 'StatusType'];
		$response = new ArrayObject;
		
		// Loop subscription files
		foreach($this->response->QuantumViewEvents->SubscriptionEvents->SubscriptionFile as $subcriptionFile) {
			foreach($subcriptionFile as $eventName => $event) {
				if (!in_array($eventName, $eventsException)) {
					$eventObject = new ArrayObject;
					$eventObject->offsetSet('Event', $eventName);
					$event = $this->convertXmlObject($eventObject, $event);
					$response->append($event);
				}
			}
		}
		
		return $response;
	}
	
	/**
	 * Convert XMLSimpleObject to ArrayObject
	 * 
	 * @param   XMLSimpleObject
	 * @return  ArrayObject
	 */
	private function convertXmlObject($arrayObject, $xmlObject) {		
		foreach($xmlObject as $key=>$value) {
			if ($value instanceof SimpleXMLElement) $value = $this->convertXmlObject(new ArrayObject, $value);
			$arrayObject->offsetSet($key, $value);
		}
		
		return $arrayObject;
	}
}
