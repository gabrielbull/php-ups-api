<?php

namespace Ups\ValueObject;

final class CashType
{
    public const PICKUP_ONLY = '01';
    public const TRANSPORTATION_ONLY = '02';
    public const PICKUP_AND_TRANSPORTATION = '03';

    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function pickupOnly(): self
    {
        return new self(self::PICKUP_ONLY);
    }

    public static function transportationOnly(): self
    {
        return new self(self::TRANSPORTATION_ONLY);
    }

    public static function pickupAndTransportation(): self
    {
        return new self(self::PICKUP_AND_TRANSPORTATION);
    }

    public function get(): string
    {
        return $this->value;
    }
}
