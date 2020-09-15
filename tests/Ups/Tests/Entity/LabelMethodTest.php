<?php namespace Ups\Tests\Entity;

use DOMDocument;
use DOMElement;
use PHPUnit\Framework\TestCase;
use Ups\Entity\LabelMethod;

class LabelMethodTest extends TestCase
{
    private $data;

    public function setUp(): void
    {
        $this->data = (object) (array(
                    'Code' => LabelMethod::C_PRINT,
                    'Description' => 'Test description'
                ));
    }

    public function testConstruct()
    {
        $lm = new LabelMethod($this->data);
        $this->assertInstanceOf('Ups\Entity\LabelMethod', $lm);
        $this->assertNotEmpty($lm->getCode());
        $this->assertNotEmpty($lm->getDescription());
        $this->assertEquals($lm->getCode(), LabelMethod::C_PRINT);
    }

    public function testSetCode()
    {
        $lm = new LabelMethod();
        $lm->setCode(LabelMethod::C_PRINT);
        $this->assertEquals($lm->getCode(), LabelMethod::C_PRINT);
    }

    public function testSetDescription()
    {
        $lm = new LabelMethod();
        $lm->setDescription('Test');
        $this->assertEquals($lm->getDescription(), 'Test');
    }

    public function testValidXML()
    {
        $doc = new DOMDocument();
        $doc->formatOutput = true;

        $forms = new LabelMethod($this->data);
        $node = $forms->toNode($doc);
        $doc->appendChild($node);

        $this->assertTrue($node instanceof DOMElement);
        $this->assertTrue($doc instanceof DOMDocument);
        $this->assertEquals($node->nodeName, 'LabelMethod');
        $this->assertEquals($node->getElementsByTagName('Code')->length, 1);
        $this->assertEquals($node->getElementsByTagName('Description')->length, 1);
    }
}
