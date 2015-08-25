<?php

namespace Ups;

use DateTime;
use Exception;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Ups\Exception\EndpointConnectionException;
use Ups\Exception\InvalidResponseException;

class Request implements RequestInterface, LoggerAwareInterface
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
        if ($logger) {
            $this->setLogger($logger);
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
     * @param string $access      The access request xml
     * @param string $request     The request xml
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

        // Log request
        $id = null;
        if ($this->logger) {
            $date = new DateTime();
            $id = $date->format('YmdHisu');
            $this->logger->info('Request To UPS API', [
                'id'          => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);
            $this->logger->debug('Request: '.$this->getRequest(), [
                'id'          => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);
        }

        try {
            $client = new Guzzle();

            $response = $client->post(
                $this->getEndpointUrl(),
                [
                    'body'    => $this->getAccess().$this->getRequest(),
                    'headers' => [
                        'Content-type'   => 'application/x-www-form-urlencoded; charset=utf-8',
                        'Accept-Charset' => 'UTF-8',
                    ],
                    'http_errors' => true,
                ]
            );

            if ($this->logger) {
                $this->logger->info('Response from UPS API', [
                    'id'          => $id,
                    'endpointurl' => $this->getEndpointUrl(),
                ]);
                $this->logger->debug('Response: '.$response->getBody(), [
                    'id'          => $id,
                    'endpointurl' => $this->getEndpointUrl(),
                ]);
            }

            if ($response->getStatusCode() === 200) {
                $body = $response->getBody();

                if (function_exists('mb_convert_encoding')) {
                    $body = mb_convert_encoding($body, 'UTF-8', mb_detect_encoding($body));
                }

                $xml = new SimpleXMLElement($body);
                if (isset($xml->Response) && isset($xml->Response->ResponseStatusCode)) {
                    if ($xml->Response->ResponseStatusCode == 1) {
                        $responseInstance = new Response();

                        return $responseInstance->setText($body)->setResponse($xml);
                    } elseif ($xml->Response->ResponseStatusCode == 0) {
                        throw new InvalidResponseException('Failure: '.$xml->Response->Error->ErrorDescription.' ('.$xml->Response->Error->ErrorCode.')');
                    }
                } else {
                    throw new InvalidResponseException('Failure: response is in an unexpected format.');
                }
            }
        } catch (ConnectException $e) { // A GuzzleHttp\Exception\ConnectException exception is thrown in the event of a networking error.
            if ($this->logger) {
                $this->logger->alert('Connection to endpoint failed', [
                    'id'          => $id,
                    'endpointurl' => $this->getEndpointUrl(),
                ]);
            }

            throw new EndpointConnectionException('Failure: Connection to Endpoint URL failed.');
        } catch (TransferException $e) { // GuzzleHttp\Exception\TransferException. Catching this exception will catch any exception that can be thrown while transferring requests.
            // Includes the ConnectException, but we want separate errors
            if ($this->logger) {
                $this->logger->alert('Transfer from endpoint failed', [
                    'id'          => $id,
                    'endpointurl' => $this->getEndpointUrl(),
                ]);
            }

            throw new EndpointConnectionException('Failure: Transfer from endpoint failed.');
        } catch (ClientException $e) { // A GuzzleHttp\Exception\ClientException is thrown for 400 level errors if the http_errors request option is set to true.
            throw $e;
        } catch (InvalidResponseException $e) {
            if ($this->logger) {
                $this->logger->critical('UPS Response is invalid', ['id' => $id]);
            }

            throw $e;
        } catch (Exception $e) {
            if ($this->logger) {
                $this->logger->alert($e->getMessage(), [
                    'id'          => $id,
                    'endpointurl' => $this->getEndpointUrl(),
                ]);
            }

            throw $e;
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
