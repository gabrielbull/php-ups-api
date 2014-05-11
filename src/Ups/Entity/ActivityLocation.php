<?php
namespace Ups\Entity;

class ActivityLocation
{
    public $AddressArtifactFormat;

    function __construct($response = null)
    {
        $this->AddressArtifactFormat = new AddressArtifactFormat();

        if (null != $response) {
            if (isset($response->AddressArtifactFormat)) {
                $this->AddressArtifactFormat = new AddressArtifactFormat($response->AddressArtifactFormat);
            }
        }
    }
} 