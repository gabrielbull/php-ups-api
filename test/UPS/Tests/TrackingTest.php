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
		$tracking = new UPS\Tracking($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);

		$shipment = $tracking->track('1Z12345E1512345676');

		// Test response
		$this->assertInstanceOf('stdClass', $shipment);
		$this->assertObjectHasAttribute('Package', $shipment);
	}

	// Test track with context
	public function testTrackContext() {
		$tracking = new UPS\Tracking($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);
		$tracking->setContext('unit test');
		$tracking->track('1Z12345E1512345676');

		// Test context
		$this->assertRegExp('{<CustomerContext>.?unit test.?</CustomerContext>}msU', $tracking->response);
	}
}