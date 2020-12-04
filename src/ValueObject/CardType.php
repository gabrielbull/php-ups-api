<?php

namespace Ups\ValueObject;

final class CardType
{
    public const AMERICAN_EXPRESS = '01';
    public const DISCOVER = '03';
    public const MASTERCARD = '04';
    public const VISA = '06';

    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function americanExpress(): self
    {
        return new self(self::AMERICAN_EXPRESS);
    }

    public static function discover(): self
    {
        return new self(self::DISCOVER);
    }

    public static function mastercard(): self
    {
        return new self(self::MASTERCARD);
    }

    public static function visa(): self
    {
        return new self(self::VISA);
    }

    public function get(): string
    {
        return $this->value;
    }
}
