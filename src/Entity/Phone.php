<?php

namespace Ups\Entity;

use DOMDocument;
use DOMNode;
use Ups\NodeInterface;

class Phone implements NodeInterface
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var null|string
     */
    private $extension;

    public function __construct(string $number, ?string $extension)
    {
        $this->number = $number;
        $this->extension = $extension;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Phone');
        $node->appendChild($document->createElement('Number', $this->getNumber()));

        if ($this->getExtension()) {
            $node->appendChild($document->createElement('Extension', $this->getExtension()));
        }

        return $node;
    }
}
