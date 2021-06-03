<?php

namespace Ups\Entity;

trait EstimatedArrivalTrait
{
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
    public function build(\stdClass $response = null)
    {
        if (null !== $response) {
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
     * @return Arrival
     */
    public function getArrival()
    {
        return $this->Arrival;
    }

    /**
     * @param Arrival $Arrival
     * @return static
     */
    public function setArrival($Arrival)
    {
        $this->Arrival = $Arrival;

        return $this;
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
     * @return static
     */
    public function setPickup($Pickup)
    {
        $this->Pickup = $Pickup;

        return $this;
    }

    /**
     * @return string
     */
    public function getDayOfWeek()
    {
        return $this->DayOfWeek;
    }

    /**
     * @param string $DayOfWeek
     * @return static
     */
    public function setDayOfWeek($DayOfWeek)
    {
        $this->DayOfWeek = $DayOfWeek;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCenterCutoff()
    {
        return $this->CustomerCenterCutoff;
    }

    /**
     * @param string $CustomerCenterCutoff
     * @return static
     */
    public function setCustomerCenterCutoff($CustomerCenterCutoff)
    {
        $this->CustomerCenterCutoff = $CustomerCenterCutoff;

        return $this;
    }

    /**
     * @return string
     */
    public function getDelayCount()
    {
        return $this->DelayCount;
    }

    /**
     * @param string $DelayCount
     * @return static
     */
    public function setDelayCount($DelayCount)
    {
        $this->DelayCount = $DelayCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getHolidayCount()
    {
        return $this->HolidayCount;
    }

    /**
     * @param string $HolidayCount
     * @return static
     */
    public function setHolidayCount($HolidayCount)
    {
        $this->HolidayCount = $HolidayCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getRestDays()
    {
        return $this->RestDays;
    }

    /**
     * @param string $RestDays
     * @return static
     */
    public function setRestDays($RestDays)
    {
        $this->RestDays = $RestDays;

        return $this;
    }

    /**
     * @return string
     */
    public function getTotalTransitDays()
    {
        return $this->TotalTransitDays;
    }

    /**
     * @param string $TotalTransitDays
     * @return static
     */
    public function setTotalTransitDays($TotalTransitDays)
    {
        $this->TotalTransitDays = $TotalTransitDays;

        return $this;
    }
}
