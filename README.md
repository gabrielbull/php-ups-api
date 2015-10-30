# ![PHP UPS API](https://rawgit.com/gabrielbull/php-ups-api/develop/php-ups-api-logo.svg "PHP UPS API")

[![Build Status](https://api.travis-ci.org/gabrielbull/php-ups-api.svg?branch=master)](https://travis-ci.org/gabrielbull/php-ups-api)
[![StyleCI](https://styleci.io/repos/7774788/shield)](https://styleci.io/repos/7774788)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gabrielbull/php-ups-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gabrielbull/php-ups-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/gabrielbull/php-ups-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gabrielbull/php-ups-api/?branch=master)
[![Code Climate](https://codeclimate.com/github/gabrielbull/php-ups-api/badges/gpa.svg)](https://codeclimate.com/github/gabrielbull/php-ups-api)
[![Latest Stable Version](http://img.shields.io/packagist/v/gabrielbull/ups-api.svg?style=flat)](https://packagist.org/packages/gabrielbull/ups-api)
[![Total Downloads](https://img.shields.io/packagist/dt/gabrielbull/ups-api.svg?style=flat)](https://packagist.org/packages/gabrielbull/ups-api)
[![License](https://img.shields.io/packagist/l/gabrielbull/ups-api.svg?style=flat)](https://packagist.org/packages/gabrielbull/ups-api)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/22e29343-ee01-4cd1-8796-c19152c3c195/mini.png)](https://insight.sensiolabs.com/projects/22e29343-ee01-4cd1-8796-c19152c3c195)
[![Join the chat at https://gitter.im/gabrielbull/php-ups-api](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/gabrielbull/php-ups-api?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

This library is aimed at wrapping all the UPS API into a simple to use PHP Library. It currently covers the Quantum View®,
Tracking API, Shipping API, Rating API and Time in Transit API. Feel free to contribute.

## Table Of Content

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Address Validation Class](#addressvalidation-class)
    * [Example](#addressvalidation-class-example)
    * [Parameters](#addressvalidation-class-parameters)
4. [QuantumView Class](#quantumview-class)
    * [Example](#quantumview-class-example)
    * [Parameters](#quantumview-class-parameters)
5. [Tracking Class](#tracking-class)
    * [Example](#tracking-class-example)
    * [Parameters](#tracking-class-parameters)
6. [Rate Class](#rate-class)
    * [Example](#rate-class-example)
    * [Parameters](#rate-class-parameters)
7. [TimeInTransit Class](#timeintransit-class)
    * [Example](#timeintransit-class-example)
    * [Parameters](#timeintransit-class-parameters)
8. [Locator Class](#locator-class)
    * [Example](#locator-class-example)
    * [Parameters](#locator-class-parameters)
9. [Shipping Class](#shipping-class)
10. [Logging](#logging)
10. [License](#license-section)

<a name="requirements"></a>
## Requirements

This library uses PHP 5.5+.

To use the UPS API, you have to [request an access key from UPS](https://www.ups.com/upsdeveloperkit). For every request,
you will have to provide the Access Key, your UPS User ID and Password.

<a name="installation"></a>
## Installation

It is recommended that you install the PHP UPS API library [through composer](http://getcomposer.org/). To do so,
run the Composer command to install the latest stable version of PHP UPS API:

```shell
composer require gabrielbull/ups-api
```

<a name="addressvalidation-class"></a>
## Address Validation Class (Street Level)

The Address Validation Class allow you to validate an address at street level. Suggestions are given when address is invalid.

Note: UPS has two Address Validations. This is Street Level option, which includes all option
of the normal Address Validation class and adds street level validation.

Not all countries are supported, see UPS documentation. Currently US & Puerto Rico are supported.

<a name="addressvalidation-class-example"></a>
### Example

```php
$address = new \Ups\Entity\Address();
$address->setAttentionName('Test Test');
$address->setBuildingName('Test');
$address->setAddressLine1('Address Line 1');
$address->setAddressLine2('Address Line 2');
$address->setAddressLine3('Address Line 3');
$address->setStateProvinceCode('NY');
$address->setCity('New York');
$address->setCountryCode('US');
$address->setPostalCode('10000');

$xav = new \Ups\AddressValidation($accessKey, $userId, $password);
try {
    $response = $xav->validate($address, $requestOption = \Ups\AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 15);
} catch (Exception $e) {
    var_dump($e);
}
```

<a name="addressvalidation-class-parameters"></a>
### Parameters

Adress Validation parameters are:

 * `address` Address object as constructed in example
 * `requestOption` One of the three request options. See documentation. Default = Address Validation.
 * `maxSuggestion` Maximum number of suggestions to be returned. Max = 50

<a name="quantumview-class"></a>
## QuantumView Class

The QuantumView Class allow you to request a Quantum View Data subscription.

<a name="quantumview-class-example"></a>
### Example

```php
$quantumView = new Ups\QuantumView($accessKey, $userId, $password);

try {
	// Get the subscription for all events for the last hour
	$events = $quantumView->getSubscription(null, (time() - 3600));

	foreach($events as $event) {
		// Your code here
		echo $event->Type;
	}

} catch (Exception $e) {
	var_dump($e);
}
```

<a name="quantumview-class-parameters"></a>
### Parameters

QuantumView parameters are:

 * `name` Name of subscription requested by user. If _null_, all events will be returned.
 * `beginDateTime` Beginning date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
 * `endDateTime` Ending date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
 * `fileName` File name of specific subscription requested by user.
 * `bookmark` Bookmarks the file for next retrieval.

_If you provide a `beginDateTime`, but no `endDateTime`, the `endDateTime` will default to the current date time._

_To use the `fileName` parameter, do not provide a `beginDateTime`._

<a name="tracking-class"></a>
## Tracking Class

The Tracking Class allow you to track a shipment using the UPS Tracking API.

<a name="tracking-class-example"></a>
### Example using Tracking Number

```php
$tracking = new Ups\Tracking($accessKey, $userId, $password);

try {
	$shipment = $tracking->track('TRACKING NUMBER');

	foreach($shipment->Package->Activity as $activity) {
		var_dump($activity);
	}

} catch (Exception $e) {
	var_dump($e);
}
```

<a name="tracking-class-parameters"></a>
### Parameters

Tracking parameters are:

 * `trackingNumber` The package’s tracking number.
 * `requestOption` Optional processing. For Mail Innovations the only valid options are Last Activity and All activity.

<a name="tracking-class-example"></a>
### Example using Reference Number

```php
$tracking = new Ups\Tracking($accessKey, $userId, $password);

try {
    $shipment = $tracking->trackByReference('REFERENCE NUMBER');

    foreach($shipment->Package->Activity as $activity) {
        var_dump($activity);
    }

} catch (Exception $e) {
    var_dump($e);
}
```
<a name="tracking-class-parameters"></a>
### Parameters

Tracking parameters are:

 * `referenceNumber` The ability to track any UPS package or shipment by reference number. Reference numbers can be a purchase order number, job number, etc. Reference Number is supplied when generating a shipment.

<a name="rate-class"></a>
## Rate Class

The Rate Class allow you to get shipment rates using the UPS Rate API.

<a name="rate-class-example"></a>
### Example

```php
$rate = new Ups\Rate(
	$accessKey,
	$userId,
	$password
);

try {
    $shipment = new \Ups\Entity\Shipment();

    $shipperAddress = $shipment->getShipper()->getAddress();
    $shipperAddress->setPostalCode('99205');

    $address = new \Ups\Entity\Address();
    $address->setPostalCode('99205');
    $shipFrom = new \Ups\Entity\ShipFrom();
    $shipFrom->setAddress($address);

    $shipment->setShipFrom($shipFrom);

    $shipTo = $shipment->getShipTo();
    $shipTo->setCompanyName('Test Ship To');
    $shipToAddress = $shipTo->getAddress();
    $shipToAddress->setPostalCode('99205');

    $package = new \Ups\Entity\Package();
    $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
    $package->getPackageWeight()->setWeight(10);

    $dimensions = new \Ups\Entity\Dimensions();
    $dimensions->setHeight(10);
    $dimensions->setWidth(10);
    $dimensions->setLength(10);

    $unit = new \Ups\Entity\UnitOfMeasurement;
    $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

    $dimensions->setUnitOfMeasurement($unit);
    $package->setDimensions($dimensions);

    $shipment->addPackage($package);

    var_dump($rate->getRate($shipment));
} catch (Exception $e) {
    var_dump($e);
}
```
<a name="rate-class-parameters"></a>
### Parameters

 * `rateRequest` Mandatory. rateRequest Object with shipment details

This Rate class is not finished yet! Parameter should be added when it will be finished.

<a name="timeintransit-class"></a>
## TimeInTransit Class

The TimeInTransit Class allow you to get all transit times using the UPS TimeInTransit API.

<a name="timeintransit-class-example"></a>
### Example

```php
$timeInTransit = new Ups\TimeInTransit($access, $userid, $passwd);

try {
    $request = new \Ups\Entity\TimeInTransitRequest;

    // Addresses
    $from = new \Ups\Entity\AddressArtifactFormat;
    $from->setPoliticalDivision3('Amsterdam');
    $from->setPostcodePrimaryLow('1000AA');
    $from->setCountryCode('NL');
    $request->setTransitFrom($from);

    $to = new \Ups\Entity\AddressArtifactFormat;
    $to->setPoliticalDivision3('Amsterdam');
    $to->setPostcodePrimaryLow('1000AA');
    $to->setCountryCode('NL');
    $request->setTransitTo($to);

    // Weight
    $shipmentWeight = new \Ups\Entity\ShipmentWeight;
    $shipmentWeight->setWeight($totalWeight);
    $unit = new \Ups\Entity\UnitOfMeasurement;
    $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
    $shipmentWeight->setUnitOfMeasurement($unit);
    $request->setShipmentWeight($shipmentWeight);

    // Packages
    $request->setTotalPackagesInShipment(2);

    // InvoiceLines
    $invoiceLineTotal = new \Ups\Entity\InvoiceLineTotal;
    $invoiceLineTotal->setMonetaryValue(100.00);
    $invoiceLineTotal->setCurrencyCode('EUR');
    $request->setInvoiceLineTotal($invoiceLineTotal);

    // Pickup date
    $request->setPickupDate(new DateTime);

    // Get data
    $times = $timeInTransit->getTimeInTransit($request);

	foreach($times->ServiceSummary as $serviceSummary) {
		var_dump($serviceSummary);
	}

} catch (Exception $e) {
    var_dump($e);
}
```

<a name="timeintransit-class-parameters"></a>
### Parameters

 * `timeInTransitRequest` Mandatory. timeInTransitRequest Object with shipment details, see example above.

<a name="locator-class"></a>
## Locator Class

The Locator class allows you to search for UPS Access Point locations.

<a name="locator-class-example"></a>
### Example

```php
$locatorRequest = new \Ups\Entity\LocatorRequest;

$originAddress = new \Ups\Entity\OriginAddress;
$address = new \Ups\Entity\AddressKeyFormat;
$address->setCountryCode('NL');
$originAddress->setAddressKeyFormat($address);

$geocode = new \Ups\Entity\GeoCode;
$geocode->setLatitude(52.0000);
$geocode->setLongitude(4.0000);
$originAddress->setGeoCode($geocode);
$locatorRequest->setOriginAddress($originAddress);

$translate = new \Ups\Entity\Translate;
$translate->setLanguageCode('ENG');
$locatorRequest->setTranslate($translate);

$acccessPointSearch = new \Ups\Entity\AccessPointSearch;
$acccessPointSearch->setAccessPointStatus(\Ups\Entity\AccessPointSearch::STATUS_ACTIVE_AVAILABLE);

$locationSearch = new \Ups\Entity\LocationSearchCriteria;
$locationSearch->setAccessPointSearch($acccessPointSearch);
$locationSearch->setMaximumListSize(25);

$locatorRequest->setLocationSearchCriteria($locationSearch);

$unitOfMeasurement = new \Ups\Entity\UnitOfMeasurement;
$unitOfMeasurement->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KM);
$unitOfMeasurement->setDescription('Kilometers');
$locatorRequest->setUnitOfMeasurement($unitOfMeasurement);

try {
    // Get the locations
    $locator = new Ups\Locator($accessKey, $userId, $password);
    $locations = $locator->getLocations($locatorRequest, \Ups\Locator::OPTION_UPS_ACCESS_POINT_LOCATIONS);

	foreach($locations->SearchResults->DropLocation as $location) {
		// Your code here
		var_dump($location);
	}

} catch (Exception $e) {
	var_dump($e);
}
```

<a name="locator-class-parameters"></a>
### Parameters

Locator class parameters are:

 * `locatorRequest` Mandatory. locatorRequest object with request details, see example
 * `requestOption` Optional. Type of locations you are searching for.

<a name="shipping-class"></a>
## Shipping Class.

Documentation for this class is coming.

<a name="logging"></a>
## Logging

All constructors take a [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) compatible logger.

Besides that, the main UPS class has a public method `setLogger` to set it after the constructor ran.

Requests & responses (including XML, no access keys) are logged at DEBUG level. At INFO level only the event is reported, not the XML content. More severe problems (e.g. no connection) are logged with higher severity.

### Example using [Monolog](https://github.com/Seldaek/monolog)

````
// Create logger
$log = new \Monolog\Logger('ups');
$log->pushHandler(new \Monolog\Handler\StreamHandler('logs/ups.log', \Monolog\Logger::DEBUG));

// Create Rate object + insert logger
$rate = new Ups\Rate($key, $username, $password, $useIntegration, $log);
````

<a name="license-section"></a>
## License

PHP UPS API is licensed under [The MIT License (MIT)](LICENSE).
