<?php

namespace UPS\Entity;


class PickupType {
    const PKT_DAILY = '01';
    const PKT_CUSTOMERCOUNTER = '03';
    const PKT_ONETIME = '06';
    const PKT_AIR_ONCALL = "07";
    const PKT_LETTERCENTER = "19";
    const PKT_AIR_SERVICECENTER = "20";

    public $Code;
    public $Description;

    function __construct() {
        $this->Code = self::PKT_DAILY;
    }
} 