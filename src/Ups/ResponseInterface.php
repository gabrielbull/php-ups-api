<?php
namespace Ups;

use SimpleXMLElement;

interface ResponseInterface
{
    public function setResponse(SimpleXMLElement $response);
    public function getResponse();
}