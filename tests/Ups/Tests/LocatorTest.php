<?php

namespace Ups\Tests;

use Exception;
use PHPUnit_Framework_TestCase;
use Ups;

class LocatorTest extends PHPUnit_Framework_TestCase
{
    public function testCreateRequest()
    {
        $api = new Ups\Locator();
        $api->setRequest($request = new RequestMock());

        // Get locator data based on shipment address
        $locatorRequest = new \Ups\Entity\LocatorRequest();

        // $originAddress
        $originAddress = new \Ups\Entity\OriginAddress();
        $address = new \Ups\Entity\AddressKeyFormat();
        $address->setPostcodePrimaryLow('1000');
        $address->setCountryCode('NL');
        $originAddress->setAddressKeyFormat($address);
        $locatorRequest->setOriginAddress($originAddress);

        // $translate
        $translate = new \Ups\Entity\Translate();
        $translate->setLanguageCode('ENG');
        $locatorRequest->setTranslate($translate);

        // $unitOfMeasurement
        $unitOfMeasurement = new \Ups\Entity\UnitOfMeasurement();
        $unitOfMeasurement->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KM);
        $unitOfMeasurement->setDescription('Kilometers');
        $locatorRequest->setUnitOfMeasurement($unitOfMeasurement);

        try {
            // Get data
            $locations = $api->getLocations($locatorRequest, Ups\Locator::OPTION_UPS_ACCESS_POINT_LOCATIONS);
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/Locator/Request1.xml')
        );
    }
}
