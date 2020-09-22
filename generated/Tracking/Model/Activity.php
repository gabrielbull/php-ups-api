<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class Activity
{
    /**
     * @var Location|null
     */
    protected $location;

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }
}
