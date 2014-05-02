<?php

namespace UPS\Entity;


class PackagingType {
    const PT_UNKONW = '00';
    const PT_UPSLETTER = '01';
    const PT_PACKAGE = '02';
    const PT_TUBE = '03';
    const PT_PAK = '04';
    const PT_EXPRESSBOX = '21';
    const PT_25KGBOX = '24';
    const PT_10KGBOX = '25';
    const PT_PALLET = '30';
    const PT_EXPRESSBOX_SM = '2a';
    const PT_EXPRESSBOX_MD = '2b';
    const PT_EXPRESSBOX_L = '2c';

    public $Code;
    public $Description;

    function __construct() {
        $this->Code = self::PT_UNKONW;
    }
} 