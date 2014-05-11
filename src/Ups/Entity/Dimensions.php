<?php
namespace Ups\Entity;

class Dimensions
{
    public $Length;
    public $Width;
    public $Height;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->Length)) {
                $this->Length = $response->Length;
            }
            if (isset($response->Width)) {
                $this->Width = $response->Width;
            }
            if (isset($response->Height)) {
                $this->Height = $response->Height;
            }
        }
    }
} 