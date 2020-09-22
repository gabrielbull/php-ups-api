<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class Address
{
    /**
     * Postal code of state or province (if applicable).
     *
     * @var string|null
     */
    protected $postalCode;
    /**
     * State or Province name.
     *
     * @var string|null
     */
    protected $stateProvince;
    /**
     * City name.
     *
     * @var string|null
     */
    protected $city;
    /**
     * Two digit country code.
     *
     * @var string|null
     */
    protected $countryCode;

    /**
     * Postal code of state or province (if applicable).
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Postal code of state or province (if applicable).
     */
    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * State or Province name.
     */
    public function getStateProvince(): ?string
    {
        return $this->stateProvince;
    }

    /**
     * State or Province name.
     */
    public function setStateProvince(?string $stateProvince): self
    {
        $this->stateProvince = $stateProvince;

        return $this;
    }

    /**
     * City name.
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * City name.
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Two digit country code.
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * Two digit country code.
     */
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }
}
