<?php
namespace Ups\Tests;

use Ups;
use PHPUnit_Framework_TestCase;

class TrackingTest extends PHPUnit_Framework_TestCase
{
    public function testTrack()
    {
        $tracking = new Ups\Tracking($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);

        $shipment = $tracking->track('1Z12345E1512345676');

        // Test response
        $this->assertInstanceOf('stdClass', $shipment);
        $this->assertObjectHasAttribute('Package', $shipment);
    }

    public function testTrackContext()
    {
        $tracking = new Ups\Tracking($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);
        $tracking->setContext('unit test');
        $tracking->track('1Z12345E1512345676');

        // Test context
        $this->assertRegExp('{<CustomerContext>.?unit test.?</CustomerContext>}msU', $tracking->response);
    }
}