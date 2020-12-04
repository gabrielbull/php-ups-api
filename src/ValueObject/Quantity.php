<?php

namespace Ups\ValueObject;

use Webmozart\Assert\Assert;

final class Quantity
{
    /**
     * @var int
     */
    private $value;

    private function __construct(int $value)
    {
        Assert::lessThan($value, 999);
        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        Assert::numeric($value);

        return new self((int) $value);
    }

    public function get(): string
    {
        return (string) $this->value;
    }
}
