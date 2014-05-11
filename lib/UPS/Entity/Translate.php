<?php
namespace Ups\Entity;

class Translate
{
    public $LanguageCode;
    public $DialectCode;
    public $Code;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->LanguageCode)) {
                $this->LanguageCode = $response->LanguageCode;
            }
            if (isset($response->DialectCode)) {
                $this->DialectCode = $response->DialectCode;
            }
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
        }
    }
} 