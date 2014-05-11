<?php
namespace Ups;

use DOMDocument;
use SimpleXMLElement;
use Exception;
use stdClass;

/**
 * Tracking API Wrapper
 *
 * @package ups
 */
class Tracking extends Ups
{
    const ENDPOINT = '/Track';

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $requestOption;

    /**
     * Get package tracking information
     *
     * @param string $trackingNumber The package's tracking number.
     * @param string $requestOption Optional processing. For Mail Innovations the only valid options are Last Activity and All activity.
     * @return stdClass
     * @throws Exception
     */
    public function track($trackingNumber, $requestOption = 'activity')
    {
        $this->trackingNumber = $trackingNumber;
        $this->requestOption = $requestOption;

        $access = $this->createAccess();
        $request = $this->createRequest();

        $response = $this->request($access, $request, $this->compileEndpointUrl(self::ENDPOINT));

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
     * Create the Tracking request
     *
     * @return string
     */
    private function createRequest()
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement("TrackRequest"));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement("Request"));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement("RequestAction", "Track"));

        if (null !== $this->requestOption) {
            $request->appendChild($xml->createElement("RequestOption", $this->requestOption));
        }

        if (null !== $this->trackingNumber) {
            $trackRequest->appendChild($xml->createElement("TrackingNumber", $this->trackingNumber));
        }

        return $xml->saveXML();
    }

    /**
     * Format the response
     *
     * @param SimpleXMLElement $response
     * @return stdClass
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        return $this->convertXmlObject($response->Shipment);
    }
}