<?php
namespace Ups;

use SimpleXMLElement;

class Response implements ResponseInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var SimpleXMLElement
     */
    protected $reponse;

    /**
     * @return SimpleXMLElement
     */
    public function getResponse()
    {
        return $this->reponse;
    }

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
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
}