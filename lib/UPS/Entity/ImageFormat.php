<?php
namespace Ups\Entity;

class ImageFormat
{
    const IF_PDF = 'PDF';

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