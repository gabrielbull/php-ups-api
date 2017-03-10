<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ServiceOffering implements NodeInterface
{

    const SO_DIRECT_TO_RETAIL = '001';
    const SO_NOT_IN_ONE_ADL = '002';
    const SO_CLICK_AND_COLLECT = '003';
    const SO_RETAIL_TO_RETAIL = '004';
    const SO_PICKUP = '005';
    const SO_DROP_OFF = '006';
    const SO_PUDO = '007';
    const SO_EARLY_PICKUP_DELIVERY_TIME = '008';
    const SO_ACCEPT_PREPAID_DROP_OFFS = '009';
    const SO_DCO_DCR_INTERCEPT_ACCEPTED = '010';
    const SO_ACCEPTS_PAYMENTS = '011';
    const SO_PAY_AT_STORE = '012';
    const SO_ACCEPTS_RESTRICTED_ARTICLES = '013';

    /**
     * @var array
     */
    private static $serviceOfferingNames = [
        '001' => 'Direct To Retail',
        '002' => 'Not In One ADL',
        '003' => 'Click and Collect',
        '004' => 'Retail to Retail',
        '005' => 'Pickup',
        '006' => 'Drop Off',
        '007' => 'PUDO',
        '008' => 'Early Pickup Delivery Time',
        '009' => 'Accept prepaid drop offs',
        '010' => 'DCO DCR intercept accepted',
        '011' => 'Accepts Payments',
        '012' => 'Pay At Store',
        '013' => 'Accepts Restricted Articles',
    ];

    /**
     * @var string
     */
    private $code;

    /**
     * @param null|object $serviceOfferingCode
     */
    public function __construct($serviceOfferingCode)
    {
        $this->code = $serviceOfferingCode;
    }

    /**
     * @return array
     */
    public static function getServiceOfferings()
    {
        return self::$serviceOfferingNames;
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

        $node = $document->createElement('ServiceOffering');
        $node->appendChild($document->createElement('Code', $this->getCode()));

        return $node;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::$serviceOfferingNames[$this->getCode()];
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
}
