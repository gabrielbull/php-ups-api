<?php

namespace UPS\Entity;


class Guaranteed {
    const G_YES = 'Y';
    const G_NO = 'N';

    public $Code;

    function __construct() {
        $this->Code = self::G_NO;
    }
} 