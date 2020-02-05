<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Ups\Entity\Address;

/**
 * Address Validation API Wrapper to use the basic Address Validation endpoints.
 *
 * This functionality is more basic, but available in more countries than the 'extended' Address Validation methods.
 */
class SimpleAddressValidation extends Ups
{
    const ENDPOINT = '/AV';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     *
     * @todo make private
     */
    public $response;

    /**
     * @var Address
     */
    private $address;

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null $logger PSR3 compatible logger (optional)
     */
    public function __construct(
        $accessKey = null,
        $userId = null,
        $password = null,
        $useIntegration = false,
        RequestInterface $request = null,
        LoggerInterface $logger = null
    ) {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * Get address suggestions from UPS using the default Address Validation API (/AV)
     *
     * @param Address $address
     *
     * @throws Exception
     *
     * @return array
     */
    public function validate(Address $address)
    {
        $this->address = $address;

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
        }

        return $this->formatResponse($response);
    }

    /**
     * Create the AV request.
     *
     * @return string
     */
    private function createRequest()
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $avRequest = $xml->appendChild($xml->createElement('AddressValidationRequest'));
        $avRequest->setAttribute('xml:lang', 'en-US');

        $request = $avRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'AV'));

        if (null !== $this->address) {
            $addressNode = $avRequest->appendChild($xml->createElement('Address'));

            if ($this->address->getStateProvinceCode()) {
                $addressNode->appendChild($xml->createElement('StateProvinceCode', $this->address->getStateProvinceCode()));
            }
            if ($this->address->getCity()) {
                $addressNode->appendChild($xml->createElement('City', $this->address->getCity()));
            }
            if ($this->address->getCountryCode()) {
                $addressNode->appendChild($xml->createElement('CountryCode', $this->address->getCountryCode()));
            }
            if ($this->address->getPostalCode()) {
                $addressNode->appendChild($xml->createElement('PostalCode', $this->address->getPostalCode()));
            }
        }

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return array
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        $result = $this->convertXmlObject($response);

        if (!is_array($result->AddressValidationResult)) {
            return [$result->AddressValidationResult];
        }

        return $result->AddressValidationResult;
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
