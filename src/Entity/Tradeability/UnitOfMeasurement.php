<?php

namespace Ups\Entity\Tradeability;

use DOMDocument;
use DOMElement;

/**
 * Class UnitOfMeasurement.
 */
class UnitOfMeasurement extends \Ups\Entity\UnitOfMeasurement
{

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null !== $document) {
            $node = $document->createElement('UnitOfMeasure');
            $node->appendChild($document->createElement('UnitCode', ($this->getCode()) !== null ? htmlspecialchars($this->getCode()) : null));

            if ($this->getDescription() !== null) {
                $node->appendChild($document->createElement('UnitDescription', ($this->getDescription()) !== null ? htmlspecialchars($this->getDescription()) : null));
            }

            return $node;
        }

        return new DOMElement('UnitOfMeasure');
    }
}
