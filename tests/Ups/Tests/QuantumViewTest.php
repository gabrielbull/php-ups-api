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

        // Get the subscription for all events for the last hour
        $events = $quantumView->getSubscription(null, (time() - 3600));

        // Test response
        $this->assertInstanceOf('ArrayObject', $events);
        $this->assertObjectHasAttribute('Type', reset($events));

        // Test bookmarks
        $this->assertInternalType('bool', $quantumView->hasBookmark());
    }

    public function testSubscriptionContext()
    {
        $quantumView = new Ups\QuantumView($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);
        $quantumView->setContext('unit test');
        // Get the subscription for all events for the last hour
        $quantumView->getSubscription(null, (time() - 24 * 6 * 3600));

        // Test context
        $this->assertRegExp('{<CustomerContext>.?unit test.?</CustomerContext>}msU', $quantumView->response);
    }

    public function testSubscriptionBookmark()
    {
        $quantumView = new Ups\QuantumView($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);

        // Get the subscription for all events for the last 6 days
        $events = $quantumView->getSubscription(null, (time() - 518400));

        if ($quantumView->hasBookmark()) {
            $bookmark = $quantumView->getBookmark();

            $this->assertStringMatchesFormat('%a', $bookmark);

            // Get the subscription with the bookmark
            $quantumView = new Ups\QuantumView($GLOBALS['UPS_ACCESS_KEY'], $GLOBALS['UPS_USER_ID'], $GLOBALS['UPS_PASSWORD']);
            $reponse = $quantumView->getSubscription(null, (time() - 518400), null, null, $bookmark);

            // Test response
            $this->assertInstanceOf('ArrayObject', $events);
            $this->assertObjectHasAttribute('Type', reset($events));
        }
    }
}