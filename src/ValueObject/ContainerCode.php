<?php

namespace Ups\ValueObject;

final class ContainerCode
{
    public const PACKAGE = '01';
    public const UPS_LETTER = '02';
    public const PALLET = '03';

    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function package(): self
    {
        return new self(self::PACKAGE);
    }

    public static function upsLetter(): self
    {
        return new self(self::UPS_LETTER);
    }

    public static function pallet(): self
    {
        return new self(self::PALLET);
    }

    public function get(): string
    {
        return $this->value;
    }
}
