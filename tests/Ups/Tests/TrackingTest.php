<?php

namespace Ups\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ups;

class TrackingTest extends TestCase
{
    public function testCreateRequest()
    {
        $tracking = new Ups\Tracking();
        $tracking->setRequest($request = new RequestMock());
        try {
            $tracking->track('1Z12345E0000000000');
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/Track/Request1.xml')
        );
    }

    public function testCreateRequestReference()
    {
        $tracking = new Ups\Tracking();
        $tracking->setRequest($request = new RequestMock());
        try {
            $tracking->trackByReference('1Z12345E0000000000');
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/Track/Request2.xml')
        );
    }

    public function testTrack()
    {
        $tracking = new Ups\Tracking();
        $tracking->setRequest($request = new RequestMock(null, '/Track/Response1.xml'));
        $shipment = $tracking->track('1Z12345E0000000000');

        // Test response
        $this->assertInstanceOf('stdClass', $shipment);
        $this->assertObjectHasAttribute('Package', $shipment);
    }

    public function testTrackContext()
    {
        $tracking = new Ups\Tracking();
        $tracking->setRequest($request = new RequestMock(null, '/Track/Response2.xml'));
        $tracking->setContext('unit test');
        $tracking->track('1Z12345E0000000000');
        $response = $tracking->getResponse()->getResponse();

        // Test context
        $this->assertEquals('unit test', $response->Response->TransactionReference->CustomerContext);
    }
}
