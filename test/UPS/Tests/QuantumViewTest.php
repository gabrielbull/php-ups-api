<?php

namespace UPS\Tests;

use UPS;

/**
 * Quantum View Class Tests
 *
 * @package ups
 */
class QuantumViewTest extends \PHPUnit_Framework_TestCase {	
	// Test subscription
	public function testSubscription() {
		$quantumView = new UPS\QuantumView($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);
		$quantumView->setContext('unit test');
		
		// Get the subscription for all events for the last 6 days
		$events = $quantumView->getSubscription(null, (time() - 518400));
		
		$this->assertInstanceOf('ArrayObject', $events);

		// Test events
		$this->assertObjectHasAttribute('Type', reset($events));

		// Test bookmarks
		$this->assertInternalType('bool', $quantumView->hasBookmark());

		if ($quantumView->hasBookmark()) {
			$this->assertStringMatchesFormat('%a', $quantumView->getBookmark());
		}

		// Test context
		$this->assertRegExp('{<CustomerContext>.?unit test.?</CustomerContext>}msU', $quantumView->response);
	}
}