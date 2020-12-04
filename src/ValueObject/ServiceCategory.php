<?php

namespace Ups\ValueObject;

final class ServiceCategory
{
    public const DOMESTIC = '01';
    public const INTERNATIONAL = '02';
    public const TRANSBORDER = '03';

    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function international(): self
    {
        return new self(self::INTERNATIONAL);
    }

    public static function transBorder(): self
    {
        return new self(self::TRANSBORDER);
    }

    public function get(): string
    {
        return $this->value;
    }
}
