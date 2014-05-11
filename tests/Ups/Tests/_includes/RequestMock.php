<?php
namespace Ups\Tests;

use SimpleXMLElement;
use Ups\RequestInterface;
use Ups\ResponseInterface;

class RequestMock implements RequestInterface
{
    const RESPONSE_DIRECTORY = '/../_files/responses';
    const REQUEST_DIRECTORY = '/../_files/requests';

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
     * @var string
     */
    private $responsePath;

    /**
     * @param string|null $responsePath
     */
    public function __construct($responsePath = null)
    {
        $this->responsePath = $responsePath;
    }

    /**
     * @param string $request
     * @return SimpleXMLElement
     */
    public function getExpectedRequestXml($request)
    {
        $args = func_get_args();
        if (isset($args[1]) && is_array($args[1])) {
            $args = $args[1];
        } else {
            $args = null;
        }

        $request = realpath(__DIR__ . self::REQUEST_DIRECTORY . $request);
        if ($request && is_file($request)) {
            $request = file_get_contents($request);
            if (isset($args)) {
                $request = call_user_func_array('sprintf', array_merge([$request], $args));
            }
            return new SimpleXMLElement($request);
        }
        return null;
    }

    /**
     * @return SimpleXMLElement
     */
    public function getRequestXml()
    {
        return new SimpleXMLElement($this->getRequest());
    }

    /**
     * @param string|null $access The access request xml
     * @param string|null $request The request xml
     * @param string|null $endpointUrl The UPS API Endpoint URL
     * @return ResponseInterface
     */
    public function request($access = null, $request = null, $endpointUrl = null)
    {
        if (null !== $access) {
            $this->setAccess($access);
        }
        if (null !== $request) {
            $this->setRequest($request);
        }
        if (null !== $endpointUrl) {
            $this->setEndpointUrl($endpointUrl);
        }

        $response = realpath(__DIR__ . self::RESPONSE_DIRECTORY . $this->responsePath);
        if ($response && is_file($response)) {
            $response = file_get_contents($response);
            if (!empty($response)) {
                $response = new SimpleXMLElement($response);
                if (isset($response->Response) && isset($response->Response->ResponseStatusCode)) {
                    return (new ResponseMock)->setResponse($response);
                }
            }
        }
        return new ResponseMock;
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