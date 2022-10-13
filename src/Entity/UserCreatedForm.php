<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class Unit.
 */
class UserCreatedForm implements NodeInterface
{

    /**
     * @var string
     */
    private $documentID;
    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->DocumentID)) {
                $this->setDocumentID($attributes->DocumentID);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('UserCreatedForm');
        $node->appendChild($document->createElement('DocumentID', $this->getDocumentID()));

        return $node;
    }

    /**
     * @return string
     */
    public function getDocumentID()
    {
        return $this->documentID;
    }

    /**
     * @param string $number
     *
     * @return $this
     */
    public function setDocumentID($documentID)
    {
        $this->documentID = $documentID;

        return $this;
    }
}
