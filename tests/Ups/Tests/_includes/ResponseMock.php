<?php
namespace Ups\Tests;

use Ups\ResponseInterface;
use SimpleXMLElement;

class ResponseMock implements ResponseInterface
{
    /**
     * @var SimpleXMLElement
     */
    protected $response;

    /**
     * @param SimpleXMLElement $response
     * @return $this
     */
    public function setResponse(SimpleXMLElement $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    public function getResponse()
    {
        return $this->response;
    }
}