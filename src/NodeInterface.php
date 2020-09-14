<?php

namespace Ups;

use DOMDocument;
use DOMNode;

interface NodeInterface
{
    public function toNode(?DOMDocument $document = null): DOMNode;
}
