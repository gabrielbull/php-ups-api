<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Ups\Entity\Tradeability\LandedCostRequest;

/**
 * Tradeability API Wrapper.
 *
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class Tradeability extends Ups
{

    /**
     * @var
     */
    private $request;

    /**
     * @var string
     *
     * @deprecated
     */
    protected $productionBaseUrl = 'https://www.ups.com/webservices';

    /**
     * @var string
     *
     * @deprecated
     */
    protected $integrationBaseUrl = 'https://wwwcie.ups.com/webservices';

    /**
     *
     */
    const ENDPOINT_LANDEDCOST = '/LandedCost';

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
     * @param LandedCostRequest $request
     * @return TimeInTransitRequest
     * @throws Exception
     */
    public function getLandedCosts(LandedCostRequest $request)
    {
        $request = $this->createRequestLandedCost($request);
        return $this->sendRequest($request, self::ENDPOINT_LANDEDCOST);
    }

    /**
     * Creates and sends a request for the given shipment. This handles checking for
     * errors in the response back from UPS.
     *
     * @param $requestObj
     *
     * @throws Exception
     *
     * @return TimeInTransitRequest
     */
    private function sendRequest($request, $endpoint)
    {
        $endpointurl = $this->compileEndpointUrl($endpoint);
        $response = $this->getRequest()->request($this->createAccess(), $request, $endpointurl);

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        return $response;
    }

    /**
     * Create the LandedCostRequest request.
     *
     * @param LandedCostRequest $request The request details. Refer to the UPS documentation for available structure
     *
     * @return string
     */
    private function createRequestLandedCost(LandedCostRequest $landedCostRequest)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $tradeabilityRequest = $xml->appendChild($xml->createElement('LandedCostRequest'));
        $tradeabilityRequest->setAttribute('xml:lang', 'en-US');

        $request = $tradeabilityRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'LandedCost'));

        if($landedCostRequest->getQueryRequest() !== null) {
            $tradeabilityRequest->appendChild($landedCostRequest->getQueryRequest()->toNode($xml));
        }

        return $xml->saveXML();
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

}
