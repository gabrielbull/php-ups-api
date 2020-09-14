<?php

namespace Ups;

use DOMDocument;
use DOMElement;

interface NodeInterface
{
    public function toNode(?DOMDocument $document = null): DOMElement;
}
