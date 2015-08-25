<?php
namespace Ups\Tests;

use Ups;
use Exception;
use PHPUnit_Framework_TestCase;

class TimeInTransitTest extends PHPUnit_Framework_TestCase
{
    public function testCreateRequest()
    {
        $tit = new Ups\TimeInTransit();
        $tit->setRequest($request = new RequestMock());

        $data = new \Ups\Entity\TimeInTransitRequest;

        // Addresses
        $from = new \Ups\Entity\AddressArtifactFormat;
        $from->setPoliticalDivision3('Amsterdam');
        $from->setPostcodePrimaryLow('1000AA');
        $from->setCountryCode('NL');
        $data->setTransitFrom($from);

        $to = new \Ups\Entity\AddressArtifactFormat;
        $to->setPoliticalDivision3('Amsterdam');
        $to->setPostcodePrimaryLow('1000AA');
        $to->setCountryCode('NL');
        $data->setTransitTo($to);

        // Weight
        $shipmentWeight = new \Ups\Entity\ShipmentWeight;
        $shipmentWeight->setWeight(5.00);
        $unit = new \Ups\Entity\UnitOfMeasurement;
        $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
        $shipmentWeight->setUnitOfMeasurement($unit);
        $data->setShipmentWeight($shipmentWeight);

        // Packages
        $data->setTotalPackagesInShipment(2);

        // InvoiceLines
        $invoiceLineTotal = new \Ups\Entity\InvoiceLineTotal;
        $invoiceLineTotal->setMonetaryValue(100.00);
        $invoiceLineTotal->setCurrencyCode('EUR');
        $data->setInvoiceLineTotal($invoiceLineTotal);

        // Pickup date
        $data->setPickupDate(new \DateTime('2015-05-23'));

        try {
            // Get data
            $times = $tit->getTimeInTransit($data);
        } catch (Exception $e) {}

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/TimeInTransit/Request1.xml')
        );

        // Try now with documentsOnlyIndicator
        $data->setDocumentsOnlyIndicator();

        try {
            // Get data
            $times = $tit->getTimeInTransit($data);
        } catch (Exception $e) {}

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/TimeInTransit/Request2.xml')
        );
    }

    public function testRequest()
    {
        $tit = new Ups\TimeInTransit();
        $tit->setRequest($request = new RequestMock(null, '/TimeInTransit/Response1.xml'));
        $times = $tit->getTimeInTransit(new Ups\Entity\TimeInTransitRequest);

        // Test response
        $this->assertInstanceOf('\Ups\Entity\TimeInTransitResponse', $times);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitFrom);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitTo);
        $this->assertInstanceOf('\Ups\Entity\ShipmentWeight', $times->ShipmentWeight);
        $this->assertInstanceOf('\Ups\Entity\Charges', $times->InvoiceLineTotal);
        $this->assertInstanceOf('\Ups\Entity\ServiceSummary', $times->ServiceSummary[0]);
        $this->assertInternalType('string', $times->Disclaimer);
        $this->assertObjectHasAttribute('PickupDate', $times);
        $this->assertObjectHasAttribute('MaximumListSize', $times);
        $this->assertObjectHasAttribute('ServiceSummary', $times);
        $this->assertAttributeCount(3, 'ServiceSummary', $times);
    }


    public function testRequestOddCharacterParse()
    {
        $tit = new Ups\TimeInTransit();
        $tit->setRequest($request = new RequestMock(null, '/TimeInTransit/Response2.xml'));
        $times = $tit->getTimeInTransit(new Ups\Entity\TimeInTransitRequest);

        // Test response
        $this->assertInstanceOf('\Ups\Entity\TimeInTransitResponse', $times);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitFrom);
        $this->assertInstanceOf('\Ups\Entity\AddressArtifactFormat', $times->TransitTo);
        $this->assertInstanceOf('\Ups\Entity\ShipmentWeight', $times->ShipmentWeight);
        $this->assertInstanceOf('\Ups\Entity\Charges', $times->InvoiceLineTotal);
        $this->assertInstanceOf('\Ups\Entity\ServiceSummary', $times->ServiceSummary[0]);
        $this->assertInternalType('string', $times->Disclaimer);
        $this->assertObjectHasAttribute('PickupDate', $times);
        $this->assertObjectHasAttribute('MaximumListSize', $times);
        $this->assertObjectHasAttribute('ServiceSummary', $times);
        $this->assertAttributeCount(3, 'ServiceSummary', $times);
    }

    public function testRequestOddCharacterCheckContent()
    {
        $tit = new Ups\TimeInTransit();
        $tit->setRequest($request = new RequestMock(null, '/TimeInTransit/Response2.xml'));
        $times = $tit->getTimeInTransit(new Ups\Entity\TimeInTransitRequest);


        // Test response

        $this->assertContains('Ë', $times->TransitTo->PoliticalDivision3);
    }

}