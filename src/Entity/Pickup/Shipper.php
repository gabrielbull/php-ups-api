<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use Ups\NodeInterface;

class Shipper implements NodeInterface
{
    /**
     * @var null|Account
     */
    private $account;

    /**
     * @var null|ChargeCard
     */
    private $chargeCard;

    public function __construct(?Account $account, $chargeCard)
    {
        $this->account = $account;
        $this->chargeCard = $chargeCard;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function getChargeCard(): ?ChargeCard
    {
        return $this->chargeCard;
    }

    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Shipper');

        if ($this->getAccount()) {
            $node->appendChild($this->getAccount()->toNode($document));
        }

        if ($this->getChargeCard()) {
            $node->appendChild($this->getChargeCard()->toNode($document));
        }

        return $node;
    }
}
