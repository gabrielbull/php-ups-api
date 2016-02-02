<?php

namespace Ups\Tests;

use Exception;
use PHPUnit_Framework_TestCase;
use Ups;

class TrackingMITest extends PHPUnit_Framework_TestCase
{

    public function testCreateRequest()
    {
        $tracking = new Ups\Tracking();
        $tracking->setRequest($request = new RequestMock());
        try {
            $tracking->track('9102084383041101186729');
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/Track/Request3.xml')
        );
    }

    public function testTrackContext()
    {
        $tracking = new Ups\Tracking();
        $tracking->setRequest($request = new RequestMock(null, '/Track/Response3.xml'));
        $tracking->setContext('unit test');
        $tracking->track('9102084383041101186729');
        $response = $tracking->getResponse()->getResponse();
        // Test context
        $this->assertEquals('unit test', $response->Response->TransactionReference->CustomerContext);
    }
}
