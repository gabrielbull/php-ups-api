<?php
namespace Ups;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Exception;

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
        if($logger) {
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
     * Send request to UPS
     *
     * @param string $access The access request xml
     * @param string $request The request xml
     * @param string $endpointurl The UPS API Endpoint URL
     * @return ResponseInterface
     * @throws Exception
     * todo: make access, request and endpointurl nullable to make the testable
     */
    public function request($access, $request, $endpointurl)
    {
        $this->setAccess($access);
        $this->setRequest($request);
        $this->setEndpointUrl($endpointurl);

        // Log request
        if($this->logger) {
            $id = (new \DateTime)->format('YmdHisu');
            $this->logger->debug('Request To UPS API', array('id' => $id, 'request' => $this->getRequest(), 'endpointurl' => $this->getEndpointUrl()));
        }

        // Create POST request
        $form = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $this->getAccess() . $this->getRequest()
            )
        );

        $request = stream_context_create($form);

        if (!$handle = fopen($this->getEndpointUrl(), 'rb', false, $request)) {
            if($this->logger) {
                $this->logger->alert('Connection to UPS API failed', array('endpointurl' => $this->getEndpointUrl()));
            }

            throw new Exception("Failure: Connection to Endpoint URL failed.");
        }

        $response = stream_get_contents($handle);
        fclose($handle);

        if($this->logger) {
            $this->logger->debug('Response from UPS API', array('id' => $id, 'response' => $response));
        }

        if ($response != false) {
            $text = $response;
            $response = new SimpleXMLElement($response);
            if (isset($response->Response) && isset($response->Response->ResponseStatusCode)) {
                $responseInstance = new Response;
                return $responseInstance->setText($text)->setResponse($response);
            }
        }

        if($this->logger) {
            $this->logger->critical('UPS Response is invalid', array('id' => $id));
        }

        throw new Exception("Failure: Response is invalid.");
    }

    /**
     * @param $access
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