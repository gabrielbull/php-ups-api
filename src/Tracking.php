<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use stdClass;

/**
 * Tracking API Wrapper.
 */
class Tracking extends Ups
{
    const ENDPOINT = '/Track';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     *                        // todo make private
     */
    public $response;

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $referenceNumber;

    /**
     * @var string
     */
    private $requestOption;

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface $request
     * @param LoggerInterface PSR3 compatible logger (optional)
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false, RequestInterface $request = null, LoggerInterface $logger = null)
    {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * Get package tracking information.
     *
     * @param string $trackingNumber The package's tracking number.
     * @param string $requestOption Optional processing. For Mail Innovations the only valid options are Last Activity and All activity.
     *
     * @throws Exception
     *
     * @return stdClass
     */
    public function track($trackingNumber, $requestOption = 'activity')
    {
        $this->trackingNumber = $trackingNumber;
        $this->requestOption = $requestOption;

        $access = $this->createAccess();
        $request = $this->createRequest();

        $this->response = $this->getRequest()->request($access, $request, $this->compileEndpointUrl(self::ENDPOINT));
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        if ($response instanceof SimpleXMLElement && $response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Get package tracking information.
     *
     * @param string $referenceNumber Reference numbers can be a purchase order number, job number, etc. Reference number can be added when creating a shipment.
     * @throws Exception
     *
     * @return stdClass
     */
    public function trackByReference($referenceNumber, $requestOption = 'activity')
    {
        $this->referenceNumber = $referenceNumber;
        $this->requestOption = $requestOption;

        $access = $this->createAccess();
        $request = $this->createRequest();

        $this->response = $this->getRequest()->request($access, $request, $this->compileEndpointUrl(self::ENDPOINT));
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        if ($response instanceof SimpleXMLElement && $response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Create the Tracking request.
     *
     * @return string
     */
    private function createRequest()
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement('TrackRequest'));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'Track'));

        if (null !== $this->requestOption) {
            $request->appendChild($xml->createElement('RequestOption', $this->requestOption));
        }

        if (null !== $this->trackingNumber) {
            $trackRequest->appendChild($xml->createElement('TrackingNumber', $this->trackingNumber));
        }

        if (null !== $this->referenceNumber) {
            $trackRequest->appendChild($xml->createElement('ReferenceNumber'))->appendChild($xml->createElement('Value', $this->referenceNumber));
        }

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return stdClass
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        return $this->convertXmlObject($response->Shipment);
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
