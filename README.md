PHP UPS API Wrapper
===================

[![Build Status](https://travis-ci.org/gabrielbull/php-ups-api.svg)](https://travis-ci.org/gabrielbull/php-ups-api)
[![Latest Stable Version](https://poser.pugx.org/gabrielbull/ups-api/v/stable.png)](https://packagist.org/packages/gabrielbull/ups-api)
[![Total Downloads](https://poser.pugx.org/gabrielbull/ups-api/downloads.png)](https://packagist.org/packages/gabrielbull/ups-api)
[![Latest Unstable Version](https://poser.pugx.org/gabrielbull/ups-api/v/unstable.png)](https://packagist.org/packages/gabrielbull/ups-api)
[![License](https://poser.pugx.org/gabrielbull/ups-api/license.png)](https://packagist.org/packages/gabrielbull/ups-api)

This library is aimed at wrapping all the UPS API into a simple to use PHP Library. It currently covers the Quantum View®,
Tracking API, Shipping API, Rating API and Time in Transit API. Feel free to contribute.

## Table Of Content

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [QuantumView Class](#quantumview-class)
    * [Example](#quantumview-class-example)
    * [Parameters](#quantumview-class-parameters)
4. [Tracking Class](#tracking-class)
    * [Example](#tracking-class-example)
    * [Parameters](#tracking-class-parameters)
5. [Rate Class](#rate-class)
    * [Example](#rate-class-example)
    * [Parameters](#rate-class-parameters)
6. [TimeInTransit Class](#timeintransit-class)
    * [Example](#timeintransit-class-example)
    * [Parameters](#timeintransit-class-parameters)
7. [Shipping Class](#shipping-class)

<a name="requirements"></a>
## Requirements

This library uses PHP 5.3+.

To use the UPS API, you have to [request an access key from UPS](https://www.ups.com/upsdeveloperkit). For every request,
you will have to provide the Access Key, your UPS User ID and Password.

<a name="installation"></a>
## Installation

It is recommended that you install the PHP UPS API Wrapper library [through composer](http://getcomposer.org/). To do so,
add the following lines to your ``composer.json`` file.

```JSON
{
    "require": {
        "gabrielbull/ups-api": "dev-master"
    }
}
```

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
### Example

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
    $shipment = new Shipment();

    $shipperAddress = $shipment->getShipper()->getAddress();
    $shipperAddress->setPostalCode('99205');

    $shipTo = $shipment->getShipTo();
    $shipTo->setCompanyName('Test Ship To');
    $shipToAddress = $shipTo->getAddress();
    $shipToAddress->setPostalCode('99205');

    $package = new Package();
    $package->getPackagingType()->setCode(PackagingType::PT_PACKAGE);
    $package->getPackageWeight()->setWeight(10);

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
    $times = $timeInTransit->getTimeInTransit($timeInTransitequest);

	foreach($times->ServiceSummary as $serviceSummary) {
		var_dump($serviceSummary);
	}

} catch (Exception $e) {
    var_dump($e);
}
```

<a name="timeintransit-class-parameters"></a>
### Parameters

 * `timeInTransitRequest` Mandatory. timeInTransitRequest Object with shipment details

<a name="shipping-class"></a>
## Shipping Class

Documentation for this class is coming.