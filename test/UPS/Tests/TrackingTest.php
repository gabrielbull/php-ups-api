<?php

namespace UPS\Tests;

use UPS;

/**
 * Tracking Class Tests
 *
 * @package ups
 */
class TrackingTest extends \PHPUnit_Framework_TestCase {	
	// Test track
	public function testTrack() {
		$tracking = new UPS\Tracking($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD'], true);
		$tracking->setContext('unit test');

		$shipment = $tracking->track('1Z12345E1512345676');

		// Test tracking
		$this->assertInstanceOf('stdClass', $shipment);
		$this->assertObjectHasAttribute('Package', $shipment);

		// Test context
		$this->assertRegExp('{<CustomerContext>.?unit test.?</CustomerContext>}msU', $tracking->response);
	}
}