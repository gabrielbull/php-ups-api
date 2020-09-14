<?php namespace Ups\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ups\AddressValidation;
use Ups\Entity\Address;

// @todo Include also request test
class AddressValidationTest extends TestCase
{
    /**
     * @var Address
     */
    protected $address;
    /**
     * @var AddressValidation
     */
    protected $xavRequest;

    public function testCreateRequest()
    {
        $this->xavRequest->setRequest($request = new RequestMock());

        try {
            // Get data
            $response = $this->xavRequest->validate($this->address);
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/AddressValidation/Request1.xml')
        );
    }

    public function testAddressValidationResponseReturned()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response1.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate($this->address);

        $this->assertInstanceOf('\Ups\Entity\AddressValidationResponse', $response);
    }

    public function testIsValidWhenKnownAddressValidated()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response3.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate($this->address);
        $this->assertTrue($response->isValid());
    }

    public function testIsValidWhenUnKnownAddressValidated()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response1.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate($this->address);
        $this->assertFalse($response->isValid());
    }

    public function testNoCandidatesWhenUnknownAddressValidated()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response2.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate($this->address);
        $this->assertTrue($response->noCandidates());
    }

    public function testNoCandidatesWhenKnownAddressValidated()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response1.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate($this->address);
        $this->assertFalse($response->noCandidates());
    }

    public function testIsAmbiguousWhenAmbiguousAddressValidated()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response1.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate($this->address);
        $this->assertTrue($response->isAmbiguous());
    }

    public function testIsAmbiguousWhenKnownAddressValidated()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response3.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate($this->address);
        $this->assertFalse($response->isAmbiguous());
    }

    public function testNoCandidatesThrowsBadMethodExceptionOnClassificationOnlyRequests()
    {
        $this->expectException('BadMethodCallException');
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response4.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate(
            $this->address,
            AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION
        );
        $response->noCandidates();
    }

    public function testIsAmbiguousThrowsBadMethodExceptionOnClassificationOnlyRequests()
    {
        $this->expectException('BadMethodCallException');
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response4.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();

        $response = $this->xavRequest->validate(
            $this->address,
            AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION
        );
        $response->isAmbiguous();
    }

    public function testIsValidWhenClassificationOnlyRequestsReturnsValidClassification()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response4.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();
        $response = $this->xavRequest->validate(
            $this->address,
            AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION
        );
        $this->assertTrue($response->isValid());
    }

    public function testGetAddressClassificationThrowsExceptionOnAddressOnlyRequest()
    {
        $this->expectException('BadMethodCallException');
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response4.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();
        $response = $this->xavRequest->validate($this->address, AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION);
        $response->getAddressClassification();
    }

    public function testGetAddressClassificationReturnsObject()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response1.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();
        $response = $this->xavRequest->validate(
            $this->address,
            AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION_AND_CLASSIFICATION
        );
        $this->assertInstanceOf(
            'Ups\Entity\AddressValidation\AddressClassification',
            $response->getAddressClassification()
        );
    }

    public function testGetCandidateAddressList()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response1.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();
        $response = $this->xavRequest->validate(
            $this->address,
            AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION_AND_CLASSIFICATION
        );

        $this->assertEquals(3, count($response->getCandidateAddressList()));
    }

    public function testGetValidatedAddressReturnsValidAddressObject()
    {
        $this->xavRequest->setRequest(new RequestMock(null, '/AddressValidation/Response3.xml'));
        $this->xavRequest->activateReturnObjectOnValidate();
        $response = $this->xavRequest->validate(
            $this->address,
            AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION_AND_CLASSIFICATION
        );

        $validAddress = $response->getValidatedAddress();
        $this->assertInstanceOf('Ups\Entity\AddressValidation\AVAddress', $validAddress);
        $this->assertInstanceOf(
            'Ups\Entity\AddressValidation\AddressClassification',
            $validAddress->addressClassification
        );
        $this->assertEquals('2', $validAddress->addressClassification->code);
        $this->assertEquals('FLORENCE', $validAddress->getCity());
        $this->assertEquals('MS', $validAddress->getStateProvince());
        $this->assertEquals('39073', $validAddress->getPostalCode());
        $this->assertEquals('39073-9240', $validAddress->getPostalCodeWithExtension());
    }

    public function setup(): void
    {
        $this->xavRequest = new AddressValidation();

        $address = new Address();
        $address->setAttentionName('Test Test');
        $address->setBuildingName('Building 1');
        $address->setAddressLine1('Times Square 1');
        $address->setAddressLine2('First Corner');
        $address->setAddressLine3('Second Corner');
        $address->setStateProvinceCode('NY');
        $address->setCity('New York');
        $address->setCountryCode('US');
        $address->setPostalCode('50000');

        $this->address = $address;
    }
}
