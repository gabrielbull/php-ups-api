<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class Shipment
{
    /**
     * @var Package[]|null
     */
    protected $package;

    /**
     * @return Package[]|null
     */
    public function getPackage(): ?array
    {
        return $this->package;
    }

    /**
     * @param Package[]|null $package
     */
    public function setPackage(?array $package): self
    {
        $this->package = $package;

        return $this;
    }
}
