<?php namespace Ups\Tests;

use PHPUnit\Framework\TestCase;
use Ups\Exception\InvalidResponseException;
use Ups\Exception\RequestException;

class ExceptionTest extends TestCase
{
    public function testInvalidResponseException()
    {
        $exception = new InvalidResponseException('Test Message', 1);
        $this->assertInstanceOf('\Ups\Exception\InvalidResponseException', $exception);
        $this->assertInstanceOf('Exception', $exception);
        $this->assertEquals('Test Message', $exception->getMessage());
        $this->assertEquals(1, $exception->getCode());
    }

    public function testRequestException()
    {
        $exception = new RequestException('Test Message', 1);
        $this->assertInstanceOf('\Ups\Exception\RequestException', $exception);
        $this->assertInstanceOf('Exception', $exception);
        $this->assertEquals('Test Message', $exception->getMessage());
        $this->assertEquals(1, $exception->getCode());
    }
}
