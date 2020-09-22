<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class Package
{
    /**
     * @var string|null
     */
    protected $trackingNumber;
    /**
     * @var Activity[]|null
     */
    protected $activity;

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    /**
     * @return Activity[]|null
     */
    public function getActivity(): ?array
    {
        return $this->activity;
    }

    /**
     * @param Activity[]|null $activity
     */
    public function setActivity(?array $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
