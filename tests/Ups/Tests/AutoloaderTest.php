<?php
namespace Ups\Tests;

use PHPUnit_Framework_TestCase;
use Ups\Autoloader;

class AutoloaderTest extends PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        Autoloader::register();
        $this->assertContains(['Ups\\Autoloader', 'autoload'], spl_autoload_functions());
    }

    public function testAutoload()
    {
        $declared = get_declared_classes();
        $declaredCount = count($declared);
        Autoloader::autoload('Foo');
        $this->assertEquals(
            $declaredCount,
            count(get_declared_classes()),
            'Ups\\Autoloader::autoload() is trying to load classes outside of the Ups namespace'
        );
        Autoloader::autoload('Ups\\QuantumView');
        $this->assertTrue(
            in_array('Ups\\QuantumView', get_declared_classes()),
            'Ups\\Autoloader::autoload() failed to autoload the Ups\\QuantumView class'
        );
    }
}