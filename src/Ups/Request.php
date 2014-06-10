<?php
namespace Ups;

use SimpleXMLElement;
use Exception;

class Request implements RequestInterface
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
            throw new Exception("Failure: Connection to Endpoint URL failed.");
        }

        $response = stream_get_contents($handle);
        fclose($handle);

        if ($response != false) {
            $text = $response;
            $response = new SimpleXMLElement($response);
            if (isset($response->Response) && isset($response->Response->ResponseStatusCode)) {
                $responseInstance = new Response;
                return $responseInstance->setText($text)->setResponse($response);
            }
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