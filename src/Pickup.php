<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use stdClass;
use Ups\Entity\Pickup\PickupCreationRequest;

/**
 * Pickup API Wrapper.
 */
class Pickup extends Ups
{
    public const ENDPOINT = '/Pickup';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    public $response;

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null $logger PSR3 compatible logger (optional)
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false, RequestInterface $request = null, LoggerInterface $logger = null)
    {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * @return stdClass
     * @throws Exception
     */
    public function create(PickupCreationRequest $pickupCreationRequest)
    {
        $this->response = $this->getRequest()->request(
            $this->createAccess(),
            $this->createPickupCreationRequest($pickupCreationRequest),
            $this->compileEndpointUrl(self::ENDPOINT)
        );
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new \Exception('Failure (0): Unknown error', 0);
        }

        if ($response instanceof SimpleXMLElement && $response->Response->ResponseStatusCode === 0) {
            throw new \Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        }

        return $this->formatResponse($response);
    }

    private function createPickupCreationRequest(PickupCreationRequest $pickCreationRequest): string
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $pickupCreationRequest = $xml->appendChild($pickCreationRequest->toNode($xml));
        $pickupCreationRequest->setAttribute('xml:lang', 'en-US');

        $request = $pickupCreationRequest->appendChild($xml->createElement('Request'));
        $request->appendChild($xml->importNode($this->createTransactionNode(), true));

        return $xml->saveXML();
    }

    public function getRequest(): RequestInterface
    {
        if (null === $this->request) {
            $this->request = new Request($this->logger);
        }

        return $this->request;
    }

    public function setRequest(RequestInterface $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;

        return $this;
    }

    protected function sendRequest(PickupCreationRequest $pickCreationRequest): stdClass
    {
        $request = $this->createPickupCreationRequest($pickCreationRequest);

        $this->response = $this->getRequest()->request($this->createAccess(), $request, $this->compileEndpointUrl(self::ENDPOINT));
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new \Exception('Failure (0): Unknown error', 0);
        }

        if ($response->Response->ResponseStatusCode === 0) {
            throw new \Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        }

        return $this->formatResponse($response);
    }

    private function formatResponse(SimpleXMLElement $response): stdClass
    {
        // We don't need to return data regarding the response to the user
        unset($response->Response);

        return $this->convertXmlObject($response);
    }
}
