<?php declare(strict_types=1);

namespace Ups\Entity\RatingServiceSelectionRequest;

/**
 * Class Request
 * For RequestOption Rate is the only valid request option for UPS Ground Freight Pricing requests. But it all depends on the purpose of use.
 *
 * @param string $requestOption The request option: Rate, Shop, or Ratetimeintransit
 * Rate =           The server rates (The default Request option is Rate if a Request Option is not provided).
 * Shop =           The server validates the shipment, and returns rates for all UPS products from the ShipFrom to the ShipTo addresses.
 * Ratetimeintransit = The server rates with transit time information
 * Shoptimeintransit = The server validates the shipment, and returns rates and transit times for all UPS products from the ShipFrom to the ShipTo addresses.
 *
 */
class Request
{
    public const REQUEST_OPTION_RATE = 'Rate';
    public const REQUEST_OPTION_SHOP = 'Shop';
    public const REQUEST_OPTION_RATETIMEINTRANSIT = 'Ratetimeintransit';
    public const REQUEST_OPTION_SHOPTIMEINTRANSIT = 'Shoptimeintransit';
}