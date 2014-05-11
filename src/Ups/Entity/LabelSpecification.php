<?php
namespace Ups\Entity;

class LabelSpecification
{
    public $HTTPUserAgent;
    public $LabelImageFormat;

    function __construct($response = null)
    {
        $this->LabelImageFormat = new LabelImageFormat();

        if (null != $response) {
            if (isset($response->HTTPUserAgent)) {
                $this->HTTPUserAgent = $response->HTTPUserAgent;
            }
            if (isset($response->LabelImageFormat)) {
                $this->LabelImageFormat = new LabelImageFormat($response->LabelImageFormat);
            }
        }
    }
} 