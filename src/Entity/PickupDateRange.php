<?php

namespace Ups\Entity;

class PickupDateRange
{
    public $BeginDate;
    public $EndDate;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->BeginDate)) {
                $this->BeginDate = $response->BeginDate;
            }
        }
        if (isset($response->EndDate)) {
            $this->EndDate = $response->EndDate;
        }
    }
}
