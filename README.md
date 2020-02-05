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
4. [Simple Address Validation Class](#simple-addressvalidation-class)
    * [Example](#simple-addressvalidation-class-example)
    * [Parameters](#simple-addressvalidation-class-parameters)    
5. [QuantumView Class](#quantumview-class)
    * [Example](#quantumview-class-example)
    * [Parameters](#quantumview-class-parameters)
6. [Tracking Class](#tracking-class)
    * [Example](#tracking-class-example)
    * [Parameters](#tracking-class-parameters)
7. [Rate Class](#rate-class)
    * [Example](#rate-class-example)
    * [Parameters](#rate-class-parameters)
8. [RateTimeInTransit Class](#ratetimeintransit-class)
    * [Example](#ratetimeintransit-class-example)
    * [Parameters](#ratetimeintransit-class-parameters)
9. [TimeInTransit Class](#timeintransit-class)
    * [Example](#timeintransit-class-example)
    * [Parameters](#timeintransit-class-parameters)
10. [Locator Class](#locator-class)
    * [Example](#locator-class-example)
    * [Parameters](#locator-class-parameters)
11. [Tradeability Class](#tradeability-class)
    * [Example](#tradeability-class-example)
    * [Parameters](#tradeability-class-parameters)
12. [Shipping Class](#shipping-class)
    * [Example](#shipping-class-example)
    * [Parameters](#shipping-class-parameters)
13. [Logging](#logging)
14. [License](#license-section)

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

If not using composer, you must also include these libraries: [Guzzle](https://github.com/guzzle/guzzle), [Guzzle Promises](https://github.com/guzzle/promises), [Guzzle PSR7] (https://github.com/guzzle/psr7), [PHP-Fig PSR Log](https://github.com/php-fig/log), and [PHP-Fig HTTP Message](https://github.com/php-fig/http-message).

<a name="addressvalidation-class"></a>
## Address Validation Class (Street Level)

The Address Validation Class allow you to validate an address at street level. Suggestions are given when address is invalid.

Note: UPS has two Address Validations. This is Street Level option, which includes all option
of the normal Address Validation class and adds street level validation.

Currently only US & Puerto Rico are supported.

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
$xav->activateReturnObjectOnValidate(); //This is optional
try {
    $response = $xav->validate($address, $requestOption = \Ups\AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 15);
} catch (Exception $e) {
    var_dump($e);
}
```
#### AddressValidation::validateReturnAVObject()
In the code above `$xav->activateReturnObjectOnValidate()` is completely optional. Calling this method will cause 
`AddressValidation::validate()` to return an `AddressValidationResponse` object. If you do not call this method, `validate`
continues to function as it has previously. If you do not call this method, a single object with either the matched 
validated address, or the first candidate address if the address is ambiguous, will be returned.

The AddressValidationResponse object provides a number of methods to allow you to more easily query the API response to 
determine the outcome. Continuing the example from above, returning an `AddressValidationResponse` object will allow
you to be a bit more specific with how you handle the various outcomes:

```PHP

if ($response->noCandidates()) {
    //Do something clever and helpful to let the use know the address is invalid
}
if ($response->isAmbiguous()) {
    $candidateAddresses = $response->getCandidateAddressList();
    foreach($candidateAddresses as $address) {
        //Present user with list of candidate addresses so they can pick the correct one        
    }
}
if ($response->isValid()) {
    $validAddress = $response->getValidatedAddress();
    
    //Show user validated address or update their address with the 'official' address
    //Or do something else helpful...
}
```

<a name="addressvalidation-class-parameters"></a>
### Parameters

Address Validation parameters are:

 * `address` Address object as constructed in example
 * `requestOption` One of the three request options. See documentation. Default = Address Validation.
 * `maxSuggestion` Maximum number of suggestions to be returned. Max = 50
 
<a name="simple-addressvalidation-class"></a>
## Simple Address Validation Class 

The Simple Address Validation Class allow you to validate less extensive as the previous class. It returns a quality score of the supplied address and provides alternatives.

Note: UPS has two Address Validations. This is the Simple option. 

Currently only US & Puerto Rico are supported.

<a name="simple-addressvalidation-class-example"></a>
### Example

```php
$address = new \Ups\Entity\Address();
$address->setStateProvinceCode('NY');
$address->setCity('New York');
$address->setCountryCode('US');
$address->setPostalCode('10000');

$av = new \Ups\SimpleAddressValidation($accessKey, $userId, $password);
try {
 $response = $av->validate($address);
 var_dump($response);
} catch (Exception $e) {
 var_dump($e);
}
```

<a name="simpleaddressvalidation-class-parameters"></a>
### Parameters

Simple Address Validation parameters are:

* `address` Address object as constructed in example

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
### Example using Tracking Number / Mail Innovations tracking number

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
 * `requestOption` Optional processing. For Mail Innovations the only valid options are Last Activity and All activity.

<a name="tracking-class-example"></a>
### Example using Reference Number with additional parameters

```php
$tracking = new Ups\Tracking($accessKey, $userId, $password);

$tracking->setShipperNumber('SHIPPER NUMBER');

$beginDate = new \DateTime('2016-01-01');
$endDate = new \DateTime('2016-01-31');

$tracking->setBeginDate($beginDate);
$tracking->setEndDate($endDate);

try {
    $shipment = $tracking->trackByReference('REFERENCE NUMBER');

    foreach($shipment->Package->Activity as $activity) {
        var_dump($activity);
    }

} catch (Exception $e) {
    var_dump($e);
}
```

The parameters shipperNumber, beginDate and endDate are optional. Either of the parameters can be set individually. These parameters can help to narrow the search field when tracking by reference, since it might happen that the reference number used is not unique. When using tracking by tracking number these parameters are not needed since the tracking number is unique.

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
    
    // if you need this (depends of the shipper country)
    $weightUnit = new \Ups\Entity\UnitOfMeasurement;
    $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
    $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);

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

<a name="ratetimeinstransit-class"></a>
## RateTimeInTransit Class

The RateTimeInTransit Class allow you to get shipment rates like the Rate Class, but the response will also include 
TimeInTransit data.

<a name="ratetimeintransit-class-example"></a>
### Example

```php
$rate = new Ups\RateTimeInTransit(
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
    
    // if you need this (depends of the shipper country)
    $weightUnit = new \Ups\Entity\UnitOfMeasurement;
    $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
    $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);

    $dimensions = new \Ups\Entity\Dimensions();
    $dimensions->setHeight(10);
    $dimensions->setWidth(10);
    $dimensions->setLength(10);

    $unit = new \Ups\Entity\UnitOfMeasurement;
    $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

    $dimensions->setUnitOfMeasurement($unit);
    $package->setDimensions($dimensions);

    $shipment->addPackage($package);

    $deliveryTimeInformation = new \Ups\Entity\DeliveryTimeInformation();
    $deliveryTimeInformation->setPackageBillType(\Ups\Entity\DeliveryTimeInformation::PBT_NON_DOCUMENT);
    
    $pickup = new \Ups\Entity\Pickup();
    $pickup->setDate("20170520");
    $pickup->setTime("160000");
    $shipment->setDeliveryTimeInformation($deliveryTimeInformation);

    var_dump($rate->shopRatesTimeInTransit($shipment));
} catch (Exception $e) {
    var_dump($e);
}
```
<a name="ratetimeintransit-class-parameters"></a>
### Parameters

 * `rateRequest` Mandatory. rateRequest Object with shipment details

This RateTimeInTransit extends the Rate class which is not finished yet! Parameter should be added when it will be finished.

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

<a name="tradeability-class"></a>
## Tradeability Class

The Tradeability class allows you to get data for international shipments:
* Landed Costs (e.g. duties)
* Denied Party Screener
* Import Compliance
* Export License Detection

Note: only the Landed Costs API is currently implemented.

WARNING: Tradeability is only available through a SOAP API. Therefore you are required to have the [SOAP extension](http://php.net/manual/en/book.soap.php) installed on your system.

<a name="tradeability-class-example"></a>
### Example

```php
// Build request
$landedCostRequest = new \Ups\Entity\Tradeability\LandedCostRequest;

// Build shipment
$shipment = new \Ups\Entity\Tradeability\Shipment;
$shipment->setOriginCountryCode('NL');
$shipment->setDestinationCountryCode('US');
$shipment->setDestinationStateProvinceCode('TX');
$shipment->setResultCurrencyCode('EUR');
$shipment->setTariffCodeAlert(1);
$shipment->setTransportationMode(\Ups\Entity\Tradeability\Shipment::TRANSPORT_MODE_AIR);
$shipment->setTransactionReferenceId('1');

// Build product
$product = new \Ups\Entity\Tradeability\Product;
$product->setProductName('Test');
$tariffInfo = new \Ups\Entity\Tradeability\TariffInfo;
$tariffInfo->setTariffCode('5109.90.80.00');
$product->setTariffInfo($tariffInfo);
$product->setProductCountryCodeOfOrigin('BD');
$unitPrice = new \Ups\Entity\Tradeability\UnitPrice;
$unitPrice->setMonetaryValue(250);
$unitPrice->setCurrencyCode('EUR');
$product->setUnitPrice($unitPrice);
$weight = new Ups\Entity\Tradeability\Weight;
$weight->setValue(0.83);
$unitOfMeasurement = new \Ups\Entity\Tradeability\UnitOfMeasurement;
$unitOfMeasurement->setCode('kg');
$weight->setUnitOfMeasurement($unitOfMeasurement);
$product->setWeight($weight);
$quantity = new \Ups\Entity\Tradeability\Quantity;
$quantity->setValue(5);
$unitOfMeasurement = new \Ups\Entity\Tradeability\UnitOfMeasurement;
$unitOfMeasurement->setCode(\Ups\Entity\Tradeability\UnitOfMeasurement::PROD_PIECES);
$quantity->setUnitOfMeasurement($unitOfMeasurement);
$product->setQuantity($quantity);
$product->setTariffCodeAlert(1);

// Add product to shipment
$shipment->addProduct($product);

// Query request
$queryRequest = new \Ups\Entity\Tradeability\QueryRequest;
$queryRequest->setShipment($shipment);
$queryRequest->setSuppressQuestionIndicator(true);

// Build
$landedCostRequest->setQueryRequest($queryRequest);

try {
    // Get the data
    $api = new Ups\Tradeability($accessKey, $userId, $password);
    $result = $api->getLandedCosts($landedCostRequest);

    var_dump($result);
} catch (Exception $e) {
    var_dump($e);
}
```

<a name="tradeability-class-parameters"></a>
### Parameters

For the Landed Cost call, parameters are:

 * `landedCostRequest` Mandatory. landedCostRequest object with request details, see example.

<a name="shipping-class"></a>
## Shipping Class

The Shipping class allows you to register shipments. This also includes return shipments.

The shipping flow consists of 2 steps:

* Confirm: Send information to UPS to get it validated and get a digest you can use to accept the shipment.
* Accept: Finalise the shipment, mark it as it will be shipped. Get label and additional information.

Please note this is just an example. Your use case might demand more or less information to be sent to UPS.

In the example $return is used to show how a return could be handled. 

<a name="shipping-class-example"></a>
### Example

```php
    // Start shipment
    $shipment = new Ups\Entity\Shipment;

    // Set shipper
    $shipper = $shipment->getShipper();
    $shipper->setShipperNumber('XX');
    $shipper->setName('XX');
    $shipper->setAttentionName('XX');
    $shipperAddress = $shipper->getAddress();
    $shipperAddress->setAddressLine1('XX');
    $shipperAddress->setPostalCode('XX');
    $shipperAddress->setCity('XX');
    $shipperAddress->setStateProvinceCode('XX'); // required in US
    $shipperAddress->setCountryCode('XX');
    $shipper->setAddress($shipperAddress);
    $shipper->setEmailAddress('XX'); 
    $shipper->setPhoneNumber('XX');
    $shipment->setShipper($shipper);

    // To address
    $address = new \Ups\Entity\Address();
    $address->setAddressLine1('XX');
    $address->setPostalCode('XX');
    $address->setCity('XX');
    $address->setStateProvinceCode('XX');  // Required in US
    $address->setCountryCode('XX');
    $shipTo = new \Ups\Entity\ShipTo();
    $shipTo->setAddress($address);
    $shipTo->setCompanyName('XX');
    $shipTo->setAttentionName('XX');
    $shipTo->setEmailAddress('XX'); 
    $shipTo->setPhoneNumber('XX');
    $shipment->setShipTo($shipTo);

    // From address
    $address = new \Ups\Entity\Address();
    $address->setAddressLine1('XX');
    $address->setPostalCode('XX');
    $address->setCity('XX');
    $address->setStateProvinceCode('XX');  
    $address->setCountryCode('XX');
    $shipFrom = new \Ups\Entity\ShipFrom();
    $shipFrom->setAddress($address);
    $shipFrom->setName('XX');
    $shipFrom->setAttentionName($shipFrom->getName());
    $shipFrom->setCompanyName($shipFrom->getName());
    $shipFrom->setEmailAddress('XX');
    $shipFrom->setPhoneNumber('XX');
    $shipment->setShipFrom($shipFrom);

    // Sold to
    $address = new \Ups\Entity\Address();
    $address->setAddressLine1('XX');
    $address->setPostalCode('XX');
    $address->setCity('XX');
    $address->setCountryCode('XX');
    $address->setStateProvinceCode('XX');
    $soldTo = new \Ups\Entity\SoldTo;
    $soldTo->setAddress($address);
    $soldTo->setAttentionName('XX');
    $soldTo->setCompanyName($soldTo->getAttentionName());
    $soldTo->setEmailAddress('XX');
    $soldTo->setPhoneNumber('XX');
    $shipment->setSoldTo($soldTo);

    // Set service
    $service = new \Ups\Entity\Service;
    $service->setCode(\Ups\Entity\Service::S_STANDARD);
    $service->setDescription($service->getName());
    $shipment->setService($service);

    // Mark as a return (if return)
    if ($return) {
        $returnService = new \Ups\Entity\ReturnService;
        $returnService->setCode(\Ups\Entity\ReturnService::PRINT_RETURN_LABEL_PRL);
        $shipment->setReturnService($returnService);
    }

    // Set description
    $shipment->setDescription('XX');

    // Add Package
    $package = new \Ups\Entity\Package();
    $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
    $package->getPackageWeight()->setWeight(10);
    $unit = new \Ups\Entity\UnitOfMeasurement;
    $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
    $package->getPackageWeight()->setUnitOfMeasurement($unit);

    // Set Package Service Options
    $packageServiceOptions = new \Ups\Entity\PackageServiceOptions();
    $packageServiceOptions->setShipperReleaseIndicator(true);
    $package->setPackageServiceOptions($packageServiceOptions);

    // Set dimensions
    $dimensions = new \Ups\Entity\Dimensions();
    $dimensions->setHeight(50);
    $dimensions->setWidth(50);
    $dimensions->setLength(50);
    $unit = new \Ups\Entity\UnitOfMeasurement;
    $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_CM);
    $dimensions->setUnitOfMeasurement($unit);
    $package->setDimensions($dimensions);

    // Add descriptions because it is a package
    $package->setDescription('XX');

    // Add this package
    $shipment->addPackage($package);

    // Set Reference Number
    $referenceNumber = new \Ups\Entity\ReferenceNumber;
    if ($return) {
        $referenceNumber->setCode(\Ups\Entity\ReferenceNumber::CODE_RETURN_AUTHORIZATION_NUMBER);
        $referenceNumber->setValue($return_id);
    } else {
        $referenceNumber->setCode(\Ups\Entity\ReferenceNumber::CODE_INVOICE_NUMBER);
        $referenceNumber->setValue($order_id);
    }
    $shipment->setReferenceNumber($referenceNumber);

    // Set payment information
    $shipment->setPaymentInformation(new \Ups\Entity\PaymentInformation('prepaid', (object)array('AccountNumber' => 'XX')));

    // Ask for negotiated rates (optional)
    $rateInformation = new \Ups\Entity\RateInformation;
    $rateInformation->setNegotiatedRatesIndicator(1);
    $shipment->setRateInformation($rateInformation);

    // Get shipment info
    try {
        $api = new Ups\Shipping($accessKey, $userId, $password); 
    
        $confirm = $api->confirm(\Ups\Shipping::REQ_VALIDATE, $shipment);
        var_dump($confirm); // Confirm holds the digest you need to accept the result
        
        if ($confirm) {
            $accept = $api->accept($confirm->ShipmentDigest);
            var_dump($accept); // Accept holds the label and additional information
        }
    } catch (\Exception $e) {
        var_dump($e);
    }
```

If you wanted to create a printable file from the UPS Shipping label image data that came back with $accept, you would use something like the following: 

```
    $label_file = $order_id . ".gif"; 
    $base64_string = $accept->PackageResults->LabelImage->GraphicImage;
    $ifp = fopen($label_file, 'wb');
    fwrite($ifp, base64_decode($base64_string));
    fclose($ifp);
```

<a name="shipping-class-parameters"></a>
### Parameters

For the Shipping `confirm` call, the parameters are: 

 * $validation A UPS_Shipping::REQ_* constant (or null). Required
 * $shipment Shipment data container. Required
 * $labelSpec LabelSpecification data. Optional
 * $receiptSpec ShipmentRequestReceiptSpecification data. Optional

For the Shipping `accept` call, the parameters are: 

 * $shipmentDigest The UPS Shipment Digest received from a ShipConfirm request. Required

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
