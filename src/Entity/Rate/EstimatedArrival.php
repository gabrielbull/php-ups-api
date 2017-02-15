<?php

namespace Ups\Entity\Rate;

use Ups\Entity\Arrival;
use Ups\Entity\Pickup;

class EstimatedArrival
{
    public $BusinessTransitDays;
    public $Arrival;
    public $Pickup;
    public $DayOfWeek;
    public $CustomerCenterCutoff;
    public $DelayCount;
    public $HolidayCount;
    public $RestDays;
    public $TotalTransitDays;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->BusinessTransitDays)) {
                $this->BusinessTransitDays = $response->BusinessTransitDays;
            }
            if (isset($response->Arrival)) {
                $this->Arrival = new Arrival($response->Arrival);
            }
            if (isset($response->Pickup)) {
                $this->Pickup = new Pickup($response->Pickup);
            }
            if (isset($response->HolidayCount)) {
                $this->HolidayCount = $response->HolidayCount;
            }
            if (isset($response->DelayCount)) {
                $this->DelayCount = $response->DelayCount;
            }
            if (isset($response->DayOfWeek)) {
                $this->DayOfWeek = $response->DayOfWeek;
            }
            if (isset($response->TotalTransitDays)) {
                $this->TotalTransitDays = $response->TotalTransitDays;
            }
            if (isset($response->CustomerCenterCutoff)) {
                $this->CustomerCenterCutoff = $response->CustomerCenterCutoff;
            }
            if (isset($response->RestDays)) {
                $this->RestDays = $response->RestDays;
            }
        }
    }
}
