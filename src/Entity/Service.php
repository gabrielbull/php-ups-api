<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Service implements NodeInterface
{
    // Valid domestic values
    public const S_AIR_1DAYEARLYAM = '14';
    public const S_AIR_1DAY = '01';
    public const S_AIR_1DAYSAVER = '13';
    public const S_AIR_2DAYAM = '59';
    public const S_AIR_2DAY = '02';
    public const S_3DAYSELECT = '12';
    public const S_GROUND = '03';
    public const S_SURE_POST = '93';

    // Valid international values
    public const S_STANDARD = '11';
    public const S_WW_EXPRESS = '07';
    public const S_WW_EXPRESSPLUS = '54';
    public const S_WW_EXPEDITED = '08';
    public const S_SAVER = '65'; // Require for Rating, ignored for Shopping
    public const S_ACCESS_POINT = '70'; // Access Point Economy

    // Valid Poland to Poland same day values
    public const S_UPSTODAY_STANDARD = '82';
    public const S_UPSTODAY_DEDICATEDCOURIER = '83';
    public const S_UPSTODAY_INTERCITY = '84';
    public const S_UPSTODAY_EXPRESS = '85';
    public const S_UPSTODAY_EXPRESSSAVER = '86';
    public const S_UPSWW_EXPRESSFREIGHT = '96';

    // Valid Germany to Germany values
    public const S_UPSEXPRESS_1200 = '74';

    // Time in Transit Response Service Codes: United States Domestic Shipments
    public const TT_S_US_AIR_1DAYAM    = '1DM'; // UPS Next Day Air Early
    public const TT_S_US_AIR_1DAY      = '1DA'; // UPS Next Day Air
    public const TT_S_US_AIR_SAVER     = '1DP'; // UPS Next Day Air Saver
    public const TT_S_US_AIR_2DAYAM    = '2DM'; // UPS Second Day Air A.M.
    public const TT_S_US_AIR_2DAY      = '2DA'; // UPS Second Day Air
    public const TT_S_US_3DAYSELECT    = '3DS'; // UPS Three-Day Select
    public const TT_S_US_GROUND        = 'GND'; // UPS Ground
    public const TT_S_US_AIR_1DAYSATAM = '1DMS'; // UPS Next Day Air Early (Saturday Delivery)
    public const TT_S_US_AIR_1DAYSAT   = '1DAS'; // UPS Next Day Air (Saturday Delivery)
    public const TT_S_US_AIR_2DAYSAT   = '2DAS'; // UPS Second Day Air (Saturday Delivery)

    // Time in Transit Response Service Codes: Other Shipments Originating in US
    public const TT_S_US_INTL_EXPRESSPLUS = '21'; // UPS Worldwide Express Plus
    public const TT_S_US_INTL_EXPRESS     = '01'; // UPS Worldwide Express
    public const TT_S_US_INTL_SAVER       = '28'; // UPS Worldwide Express Saver
    public const TT_S_US_INTL_STANDARD    = '03'; // UPS Standard
    public const TT_S_US_INTL_EXPEDITED   = '05'; // UPS Worldwide Expedited

    // Time in Transit Response Service Codes: Shipments Originating in the EU
    // Destination is WITHIN the Origin Country
    public const TT_S_EU_EXPRESSPLUS  = '23'; // UPS Express Plus
    public const TT_S_EU_EXPRESS      = '24'; // UPS Express
    public const TT_S_EU_SAVER        = '26'; // UPS Express Saver
    public const TT_S_EU_STANDARD     = '25'; // UPS Standard

    // Time in Transit Response Service Codes: Shipments Originating in the EU
    // Destination is Another EU Country
    public const TT_S_EU_TO_EU_EXPRESSPLUS  = '22'; // UPS Express Plus
    public const TT_S_EU_TO_EU_EXPRESS      = '10'; // UPS Express
    public const TT_S_EU_TO_EU_SAVER        = '18'; // UPS Express Saver
    public const TT_S_EU_TO_EU_STANDARD     = '08'; // UPS Standard

    // Time in Transit Response Service Codes: Shipments Originating in the EU
    // Destination is Outside the EU
    public const TT_S_EU_TO_OTHER_EXPRESS_NA1  = '11'; // UPS Express NA 1
    public const TT_S_EU_TO_OTHER_EXPRESSPLUS  = '21'; // UPS Worldwide Express Plus
    public const TT_S_EU_TO_OTHER_EXPRESS      = '01'; // UPS Express
    public const TT_S_EU_TO_OTHER_SAVER        = '28'; // UPS Express Saver
    public const TT_S_EU_TO_OTHER_EXPEDITED    = '05'; // UPS Expedited
    public const TT_S_EU_TO_OTHER_STANDARD     = '68'; // UPS Standard

    private static $serviceNames = [
        '01' => 'UPS Next Day Air',
        '02' => 'UPS 2nd Day Air',
        '03' => 'UPS Ground',
        '07' => 'UPS Worldwide Express',
        '08' => 'UPS Worldwide Expedited',
        '11' => 'UPS Standard',
        '12' => 'UPS 3 Day Select',
        '13' => 'UPS Next Day Air Saver',
        '14' => 'UPS Next Day Air Early',
        '54' => 'UPS Worldwide Express Plus',
        '59' => 'UPS 2nd Day Air A.M.',
        '65' => 'UPS Worldwide Saver',
        '70' => 'UPS Access Point Economy',
        '71' => 'UPS Worldwide Express Freight Midday',
        '74' => 'UPS Express 12:00',
        '82' => 'UPS Today Standard',
        '83' => 'UPS Today Dedicated Courrier',
        '85' => 'UPS Today Express',
        '86' => 'UPS Today Express Saver',
        '96' => 'UPS Worldwide Express Freight',
        '93' => 'UPS Sure Post',
    ];

    /** @deprecated */
    public $Description;

    /**
     * @var string
     */
    private $code = self::S_GROUND;

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
     * @return array
     */
    public static function getServices()
    {
        return self::$serviceNames;
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(?DOMDocument $document = null): \DOMNode
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Service');
        $node->appendChild($document->createElement('Code', $this->getCode()));
        $node->appendChild($document->createElement('Description', $this->getDescription()));

        return $node;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::$serviceNames[$this->getCode()];
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
        $this->Description = $description;
        $this->description = $description;

        return $this;
    }
}
