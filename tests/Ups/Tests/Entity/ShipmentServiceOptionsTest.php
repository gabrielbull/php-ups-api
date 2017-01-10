<?php namespace Ups\Tests\Entity;

use Exception;
use DOMDocument;
use DOMElement;
use PHPUnit_Framework_TestCase;
use Ups\Entity\ShipmentServiceOptions;
use Ups\Entity\LabelMethod;

class ShipmentServiceOptionsTest extends PHPUnit_Framework_TestCase
{
    private $data;

    public function setUp()
    {
        $this->data = (object) (array(
                    'ImportControlIndicator' => true,
                    'LabelMethod' => (object) (array(
                        'Code' => LabelMethod::C_PRINT,
                        'Description' => 'Test description'
                ))));
    }

    public function testConstruct()
    {
        $opts = new ShipmentServiceOptions($this->data);

        $this->assertEquals($opts->isImportControlIndicator(), $this->data->ImportControlIndicator);
        $this->assertInstanceOf('Ups\Entity\ShipmentServiceOptions', $opts);
        $this->assertInstanceOf('Ups\Entity\LabelMethod', $opts->getLabelMethod());
    }

    public function testSetImportControlIndicator()
    {
        $opts = new ShipmentServiceOptions();

        $opts->setImportControlIndicator(true);
        $this->assertTrue($opts->isImportControlIndicator());
    }

    public function testValidXML()
    {
        $doc = new DOMDocument();
        $doc->formatOutput = true;

        $forms = new ShipmentServiceOptions($this->data);
        $node = $forms->toNode($doc);
        $doc->appendChild($node);

        $this->assertTrue($node instanceof DOMElement);
        $this->assertTrue($doc instanceof DOMDocument);
        $this->assertEquals($node->getElementsByTagName('LabelMethod')->length, 1);
        $this->assertEquals($node->getElementsByTagName('ImportControlIndicator')->length, 1);
    }
}
