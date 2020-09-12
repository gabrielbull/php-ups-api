<?php namespace Ups\Tests\Entity;

use DOMDocument;
use DOMElement;
use PHPUnit\Framework\TestCase;
use Ups\Entity\EEIFilingOption;
use Ups\Entity\InternationalForms;
use Ups\Entity\POA;
use Ups\Entity\ShipperFiled;
use Ups\Entity\UPSFiled;

class InternationalFormsTest extends TestCase
{
    private $data;

    public function setUp(): void
    {
        $this->data = (object) (array(
            'EEIFilingOption' => (object) (
                array(
                'Code' => EEIFilingOption::FO_UPS,
                'EmailAddress' => 'test@test.com',
                'Description' => 'Hello World',
                'UPSFiled' => (object) (array(
                    'POA' => (object) (array(
                        'Code' => POA::POA_ONE_TIME,
                        'Description' => 'Goodbye World'
                    ))
                )),
                'ShipperFiled' => (object) (array(
                    'Code' => ShipperFiled::SF_ITN,
                    'Description' => 'Sup Dog',
                    'PreDepartureITNNumber' => '12345',
                    'ExemptionLegend' => '67890'
                ))
            )
            )));
    }

    public function testConstruct()
    {
        $eei = $this->data->EEIFilingOption;
        $forms = new InternationalForms($this->data);

        $this->assertEquals($forms->getEEIFilingOption(), new EEIFilingOption($eei));
        $this->assertEquals($forms->getEEIFilingOption()->getCode(), $eei->Code);
        $this->assertEquals($forms->getEEIFilingOption()->getEmailAddress(), $eei->EmailAddress);
        $this->assertEquals($forms->getEEIFilingOption()->getDescription(), $eei->Description);
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled(), new UPSFiled($eei->UPSFiled));
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled()->getPOA(), new POA($eei->UPSFiled->POA));
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled()->getPOA()->getCode(), $eei->UPSFiled->POA->Code);
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled()->getPOA()->getDescription(), $eei->UPSFiled->POA->Description);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled(), new ShipperFiled($eei->ShipperFiled));
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getCode(), $eei->ShipperFiled->Code);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getDescription(), $eei->ShipperFiled->Description);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getPreDepartureITNNumber(), $eei->ShipperFiled->PreDepartureITNNumber);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getExemptionLegend(), $eei->ShipperFiled->ExemptionLegend);
    }

    public function testGettersAndSetters()
    {
        $eei = $this->data->EEIFilingOption;
        $forms = new InternationalForms();

        $this->assertEmpty($forms->getEEIFilingOption());

        $forms->setEEIFilingOption(new EEIFilingOption());

        $this->assertEmpty($forms->getEEIFilingOption()->getUPSFiled());
        $this->assertEmpty($forms->getEEIFilingOption()->getShipperFiled());

        $forms->getEEIFilingOption()->setUPSFiled(new UPSFiled());
        $forms->getEEIFilingOption()->setShipperFiled(new ShipperFiled());

        $this->assertEmpty($forms->getEEIFilingOption()->getUPSFiled()->getPOA());

        $forms->getEEIFilingOption()->getUPSFiled()->setPOA(new POA());

        $this->assertEmpty($forms->getEEIFilingOption()->getCode());
        $this->assertEmpty($forms->getEEIFilingOption()->getEmailAddress());
        $this->assertEmpty($forms->getEEIFilingOption()->getDescription());
        $this->assertEmpty($forms->getEEIFilingOption()->getUPSFiled()->getPOA()->getCode());
        $this->assertEmpty($forms->getEEIFilingOption()->getUPSFiled()->getPOA()->getDescription());
        $this->assertEmpty($forms->getEEIFilingOption()->getShipperFiled()->getCode());
        $this->assertEmpty($forms->getEEIFilingOption()->getShipperFiled()->getDescription());
        $this->assertEmpty($forms->getEEIFilingOption()->getShipperFiled()->getPreDepartureITNNumber());
        $this->assertEmpty($forms->getEEIFilingOption()->getShipperFiled()->getExemptionLegend());

        $forms->getEEIFilingOption()->setCode($eei->Code);
        $forms->getEEIFilingOption()->setDescription($eei->Description);
        $forms->getEEIFilingOption()->setEmailAddress($eei->EmailAddress);
        $forms->getEEIFilingOption()->getUPSFiled()->getPOA()->setCode($eei->UPSFiled->POA->Code);
        $forms->getEEIFilingOption()->getUPSFiled()->getPOA()->setDescription($eei->UPSFiled->POA->Description);
        $forms->getEEIFilingOption()->getShipperFiled()->setCode($eei->ShipperFiled->Code);
        $forms->getEEIFilingOption()->getShipperFiled()->setDescription($eei->ShipperFiled->Description);
        $forms->getEEIFilingOption()->getShipperFiled()->setPreDepartureITNNumber($eei->ShipperFiled->PreDepartureITNNumber);
        $forms->getEEIFilingOption()->getShipperFiled()->setExemptionLegend($eei->ShipperFiled->ExemptionLegend);

        $this->assertEquals($forms->getEEIFilingOption(), new EEIFilingOption($eei));
        $this->assertEquals($forms->getEEIFilingOption()->getCode(), $eei->Code);
        $this->assertEquals($forms->getEEIFilingOption()->getEmailAddress(), $eei->EmailAddress);
        $this->assertEquals($forms->getEEIFilingOption()->getDescription(), $eei->Description);
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled(), new UPSFiled($eei->UPSFiled));
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled()->getPOA(), new POA($eei->UPSFiled->POA));
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled()->getPOA()->getCode(), $eei->UPSFiled->POA->Code);
        $this->assertEquals($forms->getEEIFilingOption()->getUPSFiled()->getPOA()->getDescription(), $eei->UPSFiled->POA->Description);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled(), new ShipperFiled($eei->ShipperFiled));
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getCode(), $eei->ShipperFiled->Code);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getDescription(), $eei->ShipperFiled->Description);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getPreDepartureITNNumber(), $eei->ShipperFiled->PreDepartureITNNumber);
        $this->assertEquals($forms->getEEIFilingOption()->getShipperFiled()->getExemptionLegend(), $eei->ShipperFiled->ExemptionLegend);
    }

    public function testValidXML()
    {
        $doc = new DOMDocument();
        $doc->formatOutput = true;

        $forms = new InternationalForms($this->data);
        $node = $forms->toNode($doc);
        $doc->appendChild($node);

        $this->assertTrue($node instanceof DOMElement);
        $this->assertTrue($doc instanceof DOMDocument);
        $this->assertEquals($node->getElementsByTagName('EEIFilingOption')->length, 1);
        $this->assertEquals($node->getElementsByTagName('ShipperFiled')->length, 1);
        $this->assertEquals($node->getElementsByTagName('UPSFiled')->length, 1);
        $this->assertEquals($node->getElementsByTagName('POA')->length, 1);
    }
}
