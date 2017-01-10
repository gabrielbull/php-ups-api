<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class LabelMethod implements NodeInterface
{
    const C_PRINT_AND_MAIL = '01'; // UPS prints the label and mails the label to the customer.
    const C_ONE_ATTEMPT    = '02'; // UPS driver makes 1 attempt to bring the package label to the pickup location and pickup the package.
    const C_THREE_ATTEMPT  = '03'; // UPS driver makes 3 attempt to bring the package label to the pickup location and pickup the package.
    const C_ELECTRONIC     = '04'; // UPS electronically notifiesx the custoemr via e-mail that a label and receipt are available.
    const C_PRINT          = '05'; // The shipper prints the label and the Import Control Customer Receipt and includes w/ outbound shipment.

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $description;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
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

        $node = $document->createElement('LabelMethod');

        $code = $this->getCode();
        if (isset($code)) {
            $node->appendChild($document->createElement('Code', $code));
        }

        $description = $this->getDescription();
        if (isset($description)) {
            $node->appendChild($document->createElement('Description', $description));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
