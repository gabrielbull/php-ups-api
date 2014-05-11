<?php
namespace Ups\Entity;

class LabelImageFormat
{
    public $Code;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
        }
    }
} 