<?php
namespace Ups\Entity;

class AddressArtifactFormat
{
    public $AddressArtifactFormat;

    function __construct($response = null)
    {
        if (null != $response) {

            if (isset($response->AddressArtifactFormat)) {
                $this->AddressArtifactFormat = new Address($response->AddressArtifactFormat);
            }
        }
    }
} 