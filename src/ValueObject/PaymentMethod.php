<?php

namespace Ups\ValueObject;

final class PaymentMethod
{
    public const NO_PAYMENT_NEEDED = '00';
    public const PAY_BY_SHIPPER_ACCOUNT = '01';
    public const PAY_BY_CHARGE_CARD = '03';
    public const PAY_BY_1Z_TRACKING_NUMBER = '04';
    public const PAY_BY_CHECK_OR_MONEY_ORDER = '05';
    public const CASH = '06';
    public const PAY_BY_PAYPAL = '07';

    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function noPaymentNeeded(): self
    {
        return new self(self::NO_PAYMENT_NEEDED);
    }

    public static function payByShipperAccount(): self
    {
        return new self(self::PAY_BY_SHIPPER_ACCOUNT);
    }

    public static function payBy1ZTrackingNumber(): self
    {
        return new self(self::PAY_BY_1Z_TRACKING_NUMBER);
    }

    public static function payByChargeCard(): self
    {
        return new self(self::PAY_BY_CHARGE_CARD);
    }

    public static function cash(): self
    {
        return new self(self::CASH);
    }

    public static function payByPayPal(): self
    {
        return new self(self::PAY_BY_PAYPAL);
    }

    public static function payByCheckOrMoneyOrder(): self
    {
        return new self(self::PAY_BY_CHECK_OR_MONEY_ORDER);
    }

    public function get(): string
    {
        return $this->value;
    }
}
