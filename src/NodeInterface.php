<?php

namespace Ups;

use DOMDocument;
use DOMElement;

interface NodeInterface
{
    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null);
}