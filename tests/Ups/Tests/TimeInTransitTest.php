<?php

namespace Ups\Tests;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Ups;
use Ups\Entity\AddressArtifactFormat;
use Ups\Entity\InvoiceLineTotal;
use Ups\Entity\ShipmentWeight;
use Ups\Entity\TimeInTransitRequest;
use Ups\Entity\UnitOfMeasurement;
use Ups\TimeInTransit;

class TimeInTransitTest extends TestCase
{
    public function testCreateRequest()
    {
        $tit = new TimeInTransit();
        $tit->setRequest($request = new RequestMock());

        $data = new TimeInTransitRequest();

        // Addresses
        $from = new AddressArtifactFormat();
        $from->setPoliticalDivision3('Amsterdam');
        $from->setPostcodePrimaryLow('1000AA');
        $from->setCountryCode('NL');
        $data->setTransitFrom($from);

        $to = new AddressArtifactFormat();
        $to->setPoliticalDivision3('Amsterdam');
        $to->setPostcodePrimaryLow('1000AA');
        $to->setCountryCode('NL');
        $data->setTransitTo($to);

        // Weight
        $shipmentWeight = new ShipmentWeight();
        $shipmentWeight->setWeight(5.00);
        $unit = new UnitOfMeasurement();
        $unit->setCode(UnitOfMeasurement::UOM_KGS);
        $shipmentWeight->setUnitOfMeasurement($unit);
        $data->setShipmentWeight($shipmentWeight);

        // Packages
        $data->setTotalPackagesInShipment(2);

        // InvoiceLines
        $invoiceLineTotal = new InvoiceLineTotal();
        $invoiceLineTotal->setMonetaryValue(100.00);
        $invoiceLineTotal->setCurrencyCode('EUR');
        $data->setInvoiceLineTotal($invoiceLineTotal);

        // Pickup date
        $data->setPickupDate(new DateTime('2015-05-23'));

        try {
            // Get data
            $times = $tit->getTimeInTransit($data);
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/TimeInTransit/Request1.xml')
        );

        // Try now with documentsOnlyIndicator
        $data->setDocumentsOnlyIndicator();

        try {
            // Get data
            $times = $tit->getTimeInTransit($data);
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/TimeInTransit/Request2.xml')
        );
    }

    public function testRequest()
    {
        $tit = new TimeInTransit();
        $tit->setRequest($request = new RequestMock(null, '/TimeInTransit/Response1.xml'));
        $times = $tit->getTimeInTransit(new TimeInTransitRequest());

        // Test response
        $this->assertInstanceOf('\Ups\Entity\TimeInTransitResponse', $times);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitFrom);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitTo);
        $this->assertInstanceOf('\Ups\Entity\ShipmentWeight', $times->ShipmentWeight);
        $this->assertInstanceOf('\Ups\Entity\Charges', $times->InvoiceLineTotal);
        $this->assertInstanceOf('\Ups\Entity\ServiceSummary', $times->ServiceSummary[0]);
        $this->assertTrue(is_string($times->Disclaimer));
        $this->assertObjectHasAttribute('PickupDate', $times);
        $this->assertObjectHasAttribute('MaximumListSize', $times);
        $this->assertObjectHasAttribute('ServiceSummary', $times);
        $this->assertCount(3, $times->ServiceSummary);
    }

    public function testRequestOddCharacterParse()
    {
        $tit = new TimeInTransit();
        $tit->setRequest($request = new RequestMock(null, '/TimeInTransit/Response2.xml'));
        $times = $tit->getTimeInTransit(new TimeInTransitRequest());

        // Test response
        $this->assertInstanceOf('\Ups\Entity\TimeInTransitResponse', $times);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitFrom);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitTo);
        $this->assertInstanceOf('\Ups\Entity\ShipmentWeight', $times->ShipmentWeight);
        $this->assertInstanceOf('\Ups\Entity\Charges', $times->InvoiceLineTotal);
        $this->assertInstanceOf('\Ups\Entity\ServiceSummary', $times->ServiceSummary[0]);
        $this->assertTrue(is_string($times->Disclaimer));
        $this->assertObjectHasAttribute('PickupDate', $times);
        $this->assertObjectHasAttribute('MaximumListSize', $times);
        $this->assertObjectHasAttribute('ServiceSummary', $times);
        $this->assertCount(3, $times->ServiceSummary);
    }

    public function testRequestOddCharacterCheckContent()
    {
        $tit = new TimeInTransit();
        $tit->setRequest($request = new RequestMock(null, '/TimeInTransit/Response2.xml'));
        $times = $tit->getTimeInTransit(new TimeInTransitRequest());

        // Test response
        $this->assertNotFalse(strpos($times->TransitTo->PoliticalDivision3, 'Ë'));
    }
}
