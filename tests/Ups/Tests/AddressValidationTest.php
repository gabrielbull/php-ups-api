<?php
namespace Ups\Tests;

use Ups;
use Exception;
use PHPUnit_Framework_TestCase;

// @todo Include also request test
class AddressValidationTest extends PHPUnit_Framework_TestCase
{
    public function testCreateRequest()
    {
        $xavRequest = new \Ups\AddressValidation;
        $xavRequest->setRequest($request = new RequestMock);

        $address = new \Ups\Entity\Address;
        $address->setAttentionName('Test Test');
        $address->setBuildingName('Building 1');
        $address->setAddressLine1('Times Square 1');
        $address->setAddressLine2('First Corner');
        $address->setAddressLine3('Second Corner');
        $address->setStateProvinceCode('NY');
        $address->setCity('New York');
        $address->setCountryCode('US');
        $address->setPostalCode('50000');

        try {
            // Get data
            $response = $xavRequest->validate($address);
        } catch (Exception $e) {}

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/AddressValidation/Request1.xml')
        );
    }

}