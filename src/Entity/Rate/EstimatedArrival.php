<?php

namespace Ups\Entity\Rate;

use Ups\Entity\Arrival;
use Ups\Entity\Pickup;

class EstimatedArrival
{
    private $BusinessTransitDays;
    private $Arrival;
    private $Pickup;
    private $DayOfWeek;
    private $CustomerCenterCutoff;
    private $DelayCount;
    private $HolidayCount;
    private $RestDays;
    private $TotalTransitDays;

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

    /**
     * @return mixed
     */
    public function getBusinessTransitDays()
    {
        return $this->BusinessTransitDays;
    }

    /**
     * @param mixed $BusinessTransitDays
     */
    public function setBusinessTransitDays($BusinessTransitDays)
    {
        $this->BusinessTransitDays = $BusinessTransitDays;
    }

    /**
     * @return Arrival
     */
    public function getArrival()
    {
        return $this->Arrival;
    }

    /**
     * @param Arrival $Arrival
     */
    public function setArrival($Arrival)
    {
        $this->Arrival = $Arrival;
    }

    /**
     * @return Pickup
     */
    public function getPickup()
    {
        return $this->Pickup;
    }

    /**
     * @param Pickup $Pickup
     */
    public function setPickup($Pickup)
    {
        $this->Pickup = $Pickup;
    }

    /**
     * @return mixed
     */
    public function getDayOfWeek()
    {
        return $this->DayOfWeek;
    }

    /**
     * @param mixed $DayOfWeek
     */
    public function setDayOfWeek($DayOfWeek)
    {
        $this->DayOfWeek = $DayOfWeek;
    }

    /**
     * @return mixed
     */
    public function getCustomerCenterCutoff()
    {
        return $this->CustomerCenterCutoff;
    }

    /**
     * @param mixed $CustomerCenterCutoff
     */
    public function setCustomerCenterCutoff($CustomerCenterCutoff)
    {
        $this->CustomerCenterCutoff = $CustomerCenterCutoff;
    }

    /**
     * @return mixed
     */
    public function getDelayCount()
    {
        return $this->DelayCount;
    }

    /**
     * @param mixed $DelayCount
     */
    public function setDelayCount($DelayCount)
    {
        $this->DelayCount = $DelayCount;
    }

    /**
     * @return mixed
     */
    public function getHolidayCount()
    {
        return $this->HolidayCount;
    }

    /**
     * @param mixed $HolidayCount
     */
    public function setHolidayCount($HolidayCount)
    {
        $this->HolidayCount = $HolidayCount;
    }

    /**
     * @return mixed
     */
    public function getRestDays()
    {
        return $this->RestDays;
    }

    /**
     * @param mixed $RestDays
     */
    public function setRestDays($RestDays)
    {
        $this->RestDays = $RestDays;
    }

    /**
     * @return mixed
     */
    public function getTotalTransitDays()
    {
        return $this->TotalTransitDays;
    }

    /**
     * @param mixed $TotalTransitDays
     */
    public function setTotalTransitDays($TotalTransitDays)
    {
        $this->TotalTransitDays = $TotalTransitDays;
    }

}
