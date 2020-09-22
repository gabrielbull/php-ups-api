<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class Location
{
    /**
     * @var Address|null
     */
    protected $address;

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
