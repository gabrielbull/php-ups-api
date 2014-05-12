<?php
namespace Ups;

use DOMNode;

interface NodeInterface
{
    /**
     * @return DOMNode
     */
    public function toNode();
}