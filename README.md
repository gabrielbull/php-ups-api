UPS API PHP Wrapper
===================

Copyright 2013, Gabriel Bull, Licensed under the GNU GENERAL PUBLIC LICENSE.

This library is aimed at wrapping all the UPS APIs into a simple to use PHP Library. It currently only covers the Quantum View® and Tracking APIs, but feel free to contribute.

## UPS APIs

To use the UPS APIs, you have to [request an access key from UPS](https://www.ups.com/upsdeveloperkit). For every request, you will have to provide the Access Key, your UPS user ID and password.

## Requirements

This library uses PHP 5.4.0+.

## QuantumView Class

The QuantumView Class allow you to request a Quantum View Data subscription. 

### Example

```php
$quantumView = new ups\QuantumView(
	$accessKey,
	$userId,
	$password
);

try {
	// Get the subscription for all events for the last hour
	$events = $quantumView->getSubscription(null, (time() - 3600));
	
	foreach($events as $event) {
		// Your code here
	}
	
} catch (Exception $e) {
	var_dump($e);
}
```

### Parameters

QuantumView parameters are:

 * `name` Name of subscription requested by user. If _null_, all events will be returned.
 * `beginDateTime` Beginning date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
 * `endDateTime` Ending date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
 * `fileName` File name of specific subscription requested by user.
 * `bookmark` Bookmarks the file for next retrieval.

_If you provide a `beginDateTime`, but no `endDateTime`, the `endDateTime` will default to the current date time._

_To use the `fileName` parameter, do not provide a `beginDateTime`._