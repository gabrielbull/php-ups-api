<?php

namespace UPS;

use DOMDocument,
    SimpleXMLElement,
    Exception,
    InvalidArgumentException;

/**
 * Package Shipping API Wrapper
 *
 * Based on UPS Developer Guide, dated: 31 Dec 2012
 *
 * @package ups
 */
class Shipping extends UPS {
	private $shipConfirmEndpoint = '/ShipConfirm';
	private $shipAcceptEndpoint = '/ShipAccept';
	private $voidEndpoint = '/Void';
	private $recoverLabelEndoint = '/LabelRecovery';

	/**
	 * Create a Shipment Confirm request (generate a digest)
	 *
	 * @param  
	 * @return stdClass
	 */
	public function confirm() {
		$request = $this->createConfirmRequest();
		$response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl($this->shipConfirmEndpoint));

		if ($response->Response->ResponseStatusCode == 0) {
			throw new Exception(
				"Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}", 
				(int) $response->Response->Error->ErrorCode
			);
		} else {
			unset($response->Response);
			return $this->formatResponse($response);
		}
	}

	/**
	 * Creates a ShipConfirm request
	 *
	 * @see UPS\Shipping->confirm for parameters
	 * @return string
	 */
	private function createConfirmRequest() {
		$xml = new DOMDocument();
		$xml->formatOutput = true;

		$container = $xml->appendChild($xml->createElement('ShipmentConfirmRequest'));
		$request = $container->appendChild($xml->createElement('Request'));

		$node = $xml->importNode($this->createTransactionNode(), true);
		$request->appendChild($node);

		$request->appendChild($xml->createElement('RequestAction', 'ShipConfirm'));

		return $xml->saveXML();
	}

	/**
	 * Create a Shipment Accept request (generate a shipping label)
	 *
	 * @param  string $shipmentDigest The UPS Shipment Digest received from a ShipConfirm request.
	 * @return stdClass
	 */
	public function accept($shipmentDigest) {
		$request = $this->createAcceptRequest($shipmentDigest);
		$response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl($this->shipAcceptEndpoint));

		if ($response->Response->ResponseStatusCode == 0) {
			throw new Exception(
				"Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}", 
				(int) $response->Response->Error->ErrorCode
			);
		} else {
			return $this->formatResponse($response->ShipmentResults);
		}
	}

	/**
	 * Creates a ShipAccept request
	 *
	 * @see UPS\Shipping->accept for parameters
	 * @return string
	 */
	private function createAcceptRequest($shipmentDigest) {
		$xml = new DOMDocument();
		$xml->formatOutput = true;

		$container = $xml->appendChild($xml->createElement('ShipmentAcceptRequest'));
		$request = $container->appendChild($xml->createElement('Request'));

		$node = $xml->importNode($this->createTransactionNode(), true);
		$request->appendChild($node);

		$request->appendChild($xml->createElement('RequestAction', 'ShipAccept'));
		$request->appendChild($xml->createElement('ShipmentDigest', $shipmentDigest));

		return $xml->saveXML();
	}

	/**
	 * Void a shipping label / request
	 *
	 * @param  mixed $shipmentData string|array Either the UPS Shipment Identification Number or an array of
	 *           expanded shipment data [shipmentId:, trackingNumbers:[...]]
	 * @return stdClass
	 */
	public function void($shipmentData) {
		if (is_array($shipmentData) && !isset($shipmentData['shipmentId'])) {
			throw new InvalidArgumentException('$shipmentData parameter is required to contain a key `shipmentId`.');
		}

		$request = $this->createVoidRequest($shipmentData);
		$response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl($this->voidEndpoint));

		if ($response->Response->ResponseStatusCode == 0) {
			throw new Exception(
				"Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}", 
				(int) $response->Response->Error->ErrorCode
			);
		} else {
			unset($response->Response);
			return $this->formatResponse($response);
		}
	}

	/**
	 * Creates a void shipment request
	 *
	 * @see UPS\Shipping->void for parameters
	 * @return string
	 */
	private function createVoidRequest($shipmentData) {
		$xml = new DOMDocument();
		$xml->formatOutput = true;

		$container = $xml->appendChild($xml->createElement('VoidShipmentRequest'));
		$request = $container->appendChild($xml->createElement('Request'));

		$node = $xml->importNode($this->createTransactionNode(), true);
		$request->appendChild($node);

		$request->appendChild($xml->createElement('RequestAction', '1'));

		if (is_string($shipmentData)) {
			$request->appendChild($xml->createElement('ShipmentIdentificationNumber', strtoupper($shipmentData)));
		} else {
			$expanded = $request->appendChild($xml->createElement('ExpandedVoidShipment'));
			$expanded->appendChild($xml->createElement('ShipmentIdentificationNumber', strtoupper($shipmentData['shipmentId'])));

			if (array_key_exists('trackingNumbers', $shipmentData)) {
				foreach ($shipmentData['trackingNumbers'] as $tn) {
					$expanded->appendChild($xml->createElement('TrackingNumber', strtoupper($tn)));
				}
			}
		}

		return $xml->saveXML();
	}

	/**
	 * Recover a shipping label
	 *
	 * @param  mixed $trackingData string|array Either the tracking number or a map of ReferenceNumber data
	 * 			[value:, shipperNumber:]
	 * @param  array $labelSpecificationOpts Map of label specification data for this request. Optional.
	 * 			[userAgent:, imageFormat: 'HTML|PDF']
	 * @param  array $labelDeliveryOpts All elements are optional.
	 * 			[link:]
	 * @param  array $translateOpts Map of translation data. Optional.
	 * 			[language:, dialect:]
	 * @return stdClass
	 */
	public function recoverLabel($trackingData, $labelSpecification = null, $labelDelivery = null, $translate = null) {
		if (is_array($trackingData)) {
			if (!isset($trackingData['value'])) {
				throw new InvalidArgumentException('$trackingData parameter is required to contain `value`.');
			}

			if (!isset($trackingData['shipperNumber'])) {
				throw new InvalidArgumentException('$trackingData parameter is required to contain `shipperNumber`.');
			}
		}

		if (!empty($translate)) {
			if (!isset($translateOpts['language'])) {
				$translateOpts['language'] = 'eng';
			}

			if (!isset($translateOpts['dialect'])) {
				$translateOpts['dialect'] = 'US';
			}
		}

		$request = $this->createRecoverLabelRequest($trackingData, $labelSpecification, $labelDelivery, $translate);
		$response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl($this->recoverLabelEndpoint));

		if ($response->Response->ResponseStatusCode == 0) {
			throw new Exception(
				"Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}", 
				(int) $response->Response->Error->ErrorCode
			);
		} else {
			unset($response->Response);
			return $this->formatResponse($response);
		}
	}

	/**
	 * Creates a label recovery request
	 *
	 * @see UPS\Shipping->recoverLabel for parameters
	 * @return string
	 */
	private function createRecoverLabelRequest($trackingData, $labelSpecificationOpts = null, $labelDeliveryOpts = null, $translateOpts = null) {
		$xml = new DOMDocument();
		$xml->formatOutput = true;

		$container = $xml->appendChild($xml->createElement('LabelRecoveryRequest'));
		$request = $container->appendChild($xml->createElement('Request'));

		$node = $xml->importNode($this->createTransactionNode(), true);
		$request->appendChild($node);

		$request->appendChild($xml->createElement('RequestAction', 'LabelRecovery'));

		if (!empty($labelSpecificationOpts)) {
			$labelSpec = $request->appendChild($xml->createElement('LabelSpecification'));

			if (isset($labelSpecificationOpts['userAgent'])) {
				$labelSpec->appendChild($xml->createElement('HTTPUserAgent', $labelSpecificationOpts['userAgent']));
			}

			if (isset($labelSpecificationOpts['imageFormat'])) {
				$format = $labelSpec->appendChild($xml->createElement('LabelImageFormat'));
				$format->appendChild($xml->createElement('Code', $labelSpecificationOpts['imageFormat']));
			}
		}

		if (!empty($labelDeliveryOpts)) {
			$labelDelivery = $request->appendChild($xml->createElement('LabelDelivery'));
			$labelDelivery->appendChild($xml->createElement('LabelLinkIndicator', $labelDeliveryOpts['link']));
		}

		if (!empty($translateOpts)) {
			$translate = $request->appendChild($xml->createElement('Translate'));
			$translate->appendChild($xml->createElement('LanguageCode', $translateOpts['language']));
			$translate->appendChild($xml->createElement('DialectCode', $translateOpts['dialect']));
			$translate->appendChild($xml->createElement('Code', '01'));
		}

		return $xml->saveXML();
	}

	/**
	 * Format the response
	 * 
	 * @param   SimpleXMLElement
	 * @return  stdClass
	 */
	private function formatResponse(SimpleXMLElement $response) {
		return $this->convertXmlObject($response);
	}
}