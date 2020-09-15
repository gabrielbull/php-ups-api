<?php

namespace Ups\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ups;
use Ups\Entity\Address;

class SimpleAddressValidationTest extends TestCase
{
    public function testCreateRequest()
    {
        $validator = new Ups\SimpleAddressValidation();

        $address = new Address();
        $address->setStateProvinceCode('NY');
        $address->setCity('NYork');
        $address->setCountryCode('US');
        $address->setPostalCode('10118');

        $validator->setRequest($request = new RequestMock());

        try {
            $validator->validate($address);
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/SimpleAddressValidation/Request1.xml')
        );
    }

    public function testResponse()
    {
        $validator = new Ups\SimpleAddressValidation();
        $validator->setRequest($request = new RequestMock(null, '/SimpleAddressValidation/Response1.xml'));

        $address = new Address();
        $address->setStateProvinceCode('NY');
        $address->setCity('NYork');
        $address->setCountryCode('US');
        $address->setPostalCode('10118');
        $result = $validator->validate($address);

        // Test response
        $this->assertTrue(is_array($result));
        $this->assertCount(6, $result);

        $first = $result[0];
        $this->assertInstanceOf('stdClass', $first);
        $this->assertEquals(1, $first->Rank);
        $this->assertTrue(is_string($first->Quality));
        $this->assertEquals('0.9875', $first->Quality);
        $this->assertInstanceOf('stdClass', $first->Address);
        $this->assertEquals('NEW YORK', $first->Address->City);
        $this->assertEquals('NY', $first->Address->StateProvinceCode);
        $this->assertEquals('10118', $first->PostalCodeLowEnd);
        $this->assertEquals('10118', $first->PostalCodeHighEnd);

        $last = $result[5];
        $this->assertInstanceOf('stdClass', $last);
        $this->assertEquals(6, $last->Rank);
        $this->assertTrue(is_string($first->Quality));
        $this->assertEquals('0.9875', $last->Quality);
        $this->assertInstanceOf('stdClass', $last->Address);
        $this->assertEquals('NYC', $last->Address->City);
        $this->assertEquals('NY', $last->Address->StateProvinceCode);
        $this->assertEquals('10118', $last->PostalCodeLowEnd);
        $this->assertEquals('10118', $last->PostalCodeHighEnd);
    }
}
