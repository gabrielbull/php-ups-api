<?php

namespace Ups;

use DateTime;
use Exception;
use GuzzleHttp\Client as Guzzle;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use SimpleXMLElement;
use Ups\Exception\InvalidResponseException;
use Ups\Exception\RequestException;
use SoapClient;

class SoapRequest implements RequestInterface, LoggerAwareInterface
{
    /**
     * @var string
     */
    protected $access;

    /**
     * @var string
     */
    protected $request;

    /**
     * @var string
     */
    protected $endpointUrl;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger !== null) {
            $this->setLogger($logger);
        } else {
            $this->setLogger(new NullLogger);
        }
    }

    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Send request to UPS.
     *
     * @param string $access The access request xml
     * @param string $request The request xml
     * @param string $endpointurl The UPS API Endpoint URL
     *
     * @throws Exception
     *                   todo: make access, request and endpointurl nullable to make the testable
     *
     * @return ResponseInterface
     */
    public function request($access, $request, $endpointurl)
    {
        $this->setAccess($access);
        $this->setRequest($request);
        $this->setEndpointUrl($endpointurl);

        // Easy test
        $mode = array
        (
            'soap_version' => 'SOAP_1_1',  // use soap 1.1 client
            'trace' => 1
        );

        // initialize soap client
        $client = new SoapClient(__DIR__ . '/WSDL/LandedCost.wsdl' , $mode);

        //set endpoint url
        $client->__setLocation($endpointurl);
        $auth = (array) new SimpleXMLElement($access);
        $request = (array) new SimpleXMLElement($request);

        $operation = "ProcessLCRequest";

        $header = new \SoapHeader('http://www.ups.com/schema/xpci/1.0/auth','AccessRequest',$auth);
        $client->__setSoapHeaders($header);


        //get response
        try {
            $request = json_decode(json_encode((array)$request), true);
            $response = $client->__soapCall('ProcessLCRequest', [$request]);
        } catch (\Exception $e) {
            $xml = new SimpleXMLElement($client->__getLastResponse());
            $xml->registerXPathNamespace('err', 'http://www.ups.com/schema/xpci/1.0/error');
            $errorCode = $xml->xpath('//err:PrimaryErrorCode/err:Code');
            $errorMsg = $xml->xpath('//err:PrimaryErrorCode/err:Description');

            if (isset($errorCode[0]) && isset($errorMsg[0])) {
                throw new InvalidResponseException('Failure: ' . (string)$errorMsg . ' (' . (string)$errorCode . ')');
            }
            else {
                echo '<pre>';
                echo htmlspecialchars($client->__getLastRequest());
                echo '</pre>';
                echo '<pre>';
                echo htmlspecialchars($client->__getLastRequestHeaders());
                echo '</pre>';
                dd($e->getMessage());
            }
        }
        dd($response);

        return 1;

        // Log request
        $date = new DateTime();
        $id = $date->format('YmdHisu');
        $this->logger->info('Request To UPS API', [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);

        $this->logger->debug('Request: ' . $this->getRequest(), [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);

        try {
            $client = new Guzzle();

            $response = $client->post(
                $this->getEndpointUrl(),
                [
                    'body' => $this->getAccess() . $this->getRequest(),
                    'headers' => [
                        'Content-type' => 'application/x-www-form-urlencoded; charset=utf-8',
                        'Accept-Charset' => 'UTF-8',
                    ],
                    'http_errors' => true,
                ]
            );

            $body = (string)$response->getBody();

            $this->logger->info('Response from UPS API', [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            $this->logger->debug('Response: ' . $body, [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            if ($response->getStatusCode() === 200) {
                if (function_exists('mb_convert_encoding')) {
                    $body = mb_convert_encoding($body, 'UTF-8', mb_detect_encoding($body));
                }

                $xml = new SimpleXMLElement($body);
                if (isset($xml->Response) && isset($xml->Response->ResponseStatusCode)) {
                    if ($xml->Response->ResponseStatusCode == 1) {
                        $responseInstance = new Response();

                        return $responseInstance->setText($body)->setResponse($xml);
                    } elseif ($xml->Response->ResponseStatusCode == 0) {
                        throw new InvalidResponseException('Failure: ' . $xml->Response->Error->ErrorDescription . ' (' . $xml->Response->Error->ErrorCode . ')');
                    }
                } else {
                    throw new InvalidResponseException('Failure: response is in an unexpected format.');
                }
            }
        } catch (\GuzzleHttp\Exception\TransferException $e) { // Guzzle: All of the exceptions extend from GuzzleHttp\Exception\TransferException
            $this->logger->alert($e->getMessage(), [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            throw new RequestException('Failure: ' . $e->getMessage());
        }
    }

    /**
     * @param $access
     *
     * @return $this
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $endpointUrl
     *
     * @return $this
     */
    public function setEndpointUrl($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->endpointUrl;
    }
}
