<?php
namespace Ups;

use DOMNode;
use DOMDocument;

interface NodeInterface
{
    /**
     * @param null|DOMDocument $document
     * @return DOMNode
     */
    public function toNode(DOMDocument $document = null);
}