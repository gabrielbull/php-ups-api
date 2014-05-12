<?php
namespace Ups\Tests;

use Ups\Entity\Package;
use Ups\Entity\PackagingType;
use Ups\Entity\Service;
use Ups\Entity\Shipment;
use Ups\Rate;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * Rate Class Tests
 *
 * @package ups
 * @group Rate
 */
class RateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Rate
     */
    private $rate;

    public function setUp()
    {
        $this->rate = new Rate(null, null, null, true);
    }

    // fixme
    public function testShopRates()
    {
        /*$shipment = new \stdClass();
        $shipment->Shipper = new \stdClass();
        $shipment->Shipper->Name = 'Test Shipper';
        $shipment->Shipper->ShipperNumber = '12345';
        $shipment->Shipper->Address = new \stdClass();
        $shipment->Shipper->Address->AddressLine1 = '123 Some St.';
        $shipment->Shipper->Address->City = 'Test';
        $shipment->Shipper->Address->PostalCode = '99205';
        $shipment->Shipper->Address->StateProvinceCode = 'WA';
        $shipment->ShipTo = new \stdClass();
        $shipment->ShipTo->CompanyName = 'Test ShipTo';
        $shipment->ShipTo->Address = new \stdClass();
        $shipment->ShipTo->Address->AddressLine1 = '1234 Some St.';
        $shipment->ShipTo->Address->City = 'Other City';
        $shipment->ShipTo->Address->PostalCode = '99004';
        $shipment->ShipTo->Address->StateProvinceCode = 'WA';

        $package = new \stdClass();
        $package->PackagingType = new \stdClass();
        $package->PackagingType->Code = '02';
        $package->PackageWeight = new \stdClass();
        $package->PackageWeight->Weight = '10';
        $shipment->Package = array(
            $package,
        );

        $rates = $this->rate->shopRates($shipment);
        $this->assertGreaterThan(1, sizeof($rates->RatedShipment), 'Ensure we have multiple rates');*/
    }

    // fixme
    public function testGetRate()
    {
        /*$shipment = new \stdClass();
        $shipment->Shipper = new \stdClass();
        $shipment->Shipper->Name = 'Test Shipper';
        $shipment->Shipper->ShipperNumber = '12345';
        $shipment->Shipper->Address = new \stdClass();
        $shipment->Shipper->Address->AddressLine1 = '123 Some St.';
        $shipment->Shipper->Address->City = 'Test';
        $shipment->Shipper->Address->PostalCode = '99205';
        $shipment->Shipper->Address->StateProvinceCode = 'WA';
        $shipment->ShipTo = new \stdClass();
        $shipment->ShipTo->CompanyName = 'Test ShipTo';
        $shipment->ShipTo->Address = new \stdClass();
        $shipment->ShipTo->Address->AddressLine1 = '1234 Some St.';
        $shipment->ShipTo->Address->City = 'Other City';
        $shipment->ShipTo->Address->PostalCode = '99004';
        $shipment->ShipTo->Address->StateProvinceCode = 'WA';

        $shipment->Service = new \stdClass();
        $shipment->Service->Code = '03';

        $package = new \stdClass();
        $package->PackagingType = new \stdClass();
        $package->PackagingType->Code = '02';
        $package->PackageWeight = new \stdClass();
        $package->PackageWeight->Weight = '10';
        $shipment->Package = array(
            $package,
        );

        $rate = $this->rate->getRate($shipment);

        $this->assertEquals(1, sizeof($rate->RatedShipment), 'Ensure we only request a rate for one service');
        $this->assertEquals('03', $rate->RatedShipment->Service->Code, 'Assert the correct service is returned');
        $this->assertEquals(1, sizeof($rate->RatedShipment->RatedPackage), 'Assert we have only one package in returned quote');*/
    }

    /**
     * @expectedException \Exception
     */
    public function testGetRateInvalidShipment()
    {
        $shipment = new \stdClass();
        $shipment->Shipper = new \stdClass();
        $shipment->Shipper->Name = 'Test Shipper';
        $shipment->Shipper->ShipperNumber = '12345';
        $shipment->Shipper->Address = new \stdClass();
        $shipment->Shipper->Address->AddressLine1 = '123 Some St.';
        $shipment->Shipper->Address->City = 'Test';
        $shipment->Shipper->Address->PostalCode = '12345';
        $shipment->Shipper->Address->StateProvinceCode = 'WA';
        $shipment->ShipTo = new \stdClass();
        $shipment->ShipTo->CompanyName = 'Test ShipTo';
        $shipment->ShipTo->Address = new \stdClass();
        $shipment->ShipTo->Address->AddressLine1 = '1234 Some St.';
        $shipment->ShipTo->Address->City = 'Other City';
        $shipment->ShipTo->Address->PostalCode = '12345';
        $shipment->ShipTo->Address->StateProvinceCode = 'WA';

        $shipment->Service = new \stdClass();
        $shipment->Service->Code = '03';

        $package = new \stdClass();
        $package->PackagingType = new \stdClass();
        $package->PackagingType->Code = '02';
        $package->PackageWeight = new \stdClass();
        $package->PackageWeight->Weight = '10';
        $shipment->Package = array(
            $package,
        );

        // should throw exception cause invalid zip code
        $this->rate->getRate($shipment);
    }
}