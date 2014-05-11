<?php
namespace Ups\Tests;

use Ups;
use Exception;
use PHPUnit_Framework_TestCase;

class QuantumViewTest extends PHPUnit_Framework_TestCase
{
    public function testCreateRequest()
    {
        $quantumView = new Ups\QuantumView();
        $quantumView->setRequest($request = new RequestMock());
        $time = time() - 3600;
        $timeFormatted = $quantumView->formatDateTime($time);
        try {
            $quantumView->getSubscription(null, $time, $time);
        } catch (Exception $e) {}

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/QVEvents/Request1.xml', [$timeFormatted, $timeFormatted])
        );

        $quantumView->setContext('unit test');
        try {
            $quantumView->getSubscription(null, $time, $time);
        } catch (Exception $e) {}

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/QVEvents/Request2.xml', [$timeFormatted, $timeFormatted])
        );
    }

    public function testGetSubscription()
    {
        $quantumView = new Ups\QuantumView();
        $quantumView->setRequest(new RequestMock('/QVEvents/Response1.xml'));

        $events = $quantumView->getSubscription(null, (time() - 3600));

        // Test response
        $this->assertInstanceOf('ArrayObject', $events);
        $this->assertObjectHasAttribute('Type', reset($events));

        // Test bookmarks
        $this->assertInternalType('bool', $quantumView->hasBookmark());
    }

    public function testSubscriptionContext()
    {
        $quantumView = new Ups\QuantumView();
        $quantumView->setRequest(new RequestMock('/QVEvents/Response2.xml'));
        $quantumView->setContext('unit test');
        $quantumView->getSubscription(null, (time() - 24 * 6 * 3600));

        $response = $quantumView->getResponse()->getResponse();
        $this->assertEquals('unit test', (string)$response->Response->TransactionReference->CustomerContext);
    }

    public function testSubscriptionBookmark()
    {
        $quantumView = new Ups\QuantumView();
        $quantumView->setRequest(new RequestMock('/QVEvents/Response3.xml'));

        $quantumView->getSubscription(null, (time() - 518400));

        $this->assertTrue($quantumView->hasBookmark());
        $this->assertEquals('I3btAry3RydFAvioq9Bb3sTLBGPgYB0kZ4CSsgXCMua4NJd0OLtaI60WCfLRVF33', $quantumView->getBookmark());
    }
}