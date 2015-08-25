<?php

namespace Ups\Tests;

use SimpleXMLElement;
use Ups\ResponseInterface;

class ResponseMock implements ResponseInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var SimpleXMLElement
     */
    protected $response;

    /**
     * @param SimpleXMLElement $response
     *
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

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
