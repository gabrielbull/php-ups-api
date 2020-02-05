<?php

namespace Ups\Entity;

class DeliveryLocation
{
    public $AddressArtifactFormat;
    public $Code;
    public $Description;
    public $SignedForByName;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->AddressArtifactFormat = new AddressArtifactFormat();

        if (null !== $response) {
            if (isset($response->AddressArtifactFormat)) {
                $this->AddressArtifactFormat = new AddressArtifactFormat($response->AddressArtifactFormat);
            }
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
            if (isset($response->Description)) {
                $this->Description = $response->Description;
            }
            if (isset($response->SignedForByName)) {
                $this->SignedForByName = $response->SignedForByName;
            }
        }
    }
}
