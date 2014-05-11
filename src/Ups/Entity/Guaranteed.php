<?php
namespace Ups\Entity;

class Guaranteed
{
    const G_YES = 'Y';
    const G_NO = 'N';

    public $Code;

    function __construct($response = null)
    {
        $this->Code = self::G_NO;

        if (null != $response) {
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
        }
    }
} 