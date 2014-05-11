<?php
namespace Ups;

use SimpleXMLElement;

class Response implements ResponseInterface
{
    /**
     * @var SimpleXMLElement
     */
    protected $reponse;

    /**
     * @param SimpleXMLElement $response
     * @return $this
     */
    public function setResponse(SimpleXMLElement $response)
    {
        $this->reponse = $response;
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    public function getResponse()
    {
        return $this->reponse;
    }
}