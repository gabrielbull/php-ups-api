<?php

namespace Ups\ValueObject;

final class UnitOfMeasurement
{
    public const POUNDS = 'LBS';
    public const KILOGRAMS = 'KGS';

    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function pounds(): self
    {
        return new self(self::POUNDS);
    }

    public static function kilograms(): self
    {
        return new self(self::KILOGRAMS);
    }

    public function get(): string
    {
        return $this->value;
    }
}
