<?php

namespace Ups\Entity;

class EstimatedArrival
{
    use EstimatedArrivalTrait;

    const EA_MONDAY = 'MON';
    const EA_TUESDAY = 'TUE';
    const EA_WEDNESDAY = 'WEB';
    const EA_THUSDAY = 'THU';
    const EA_FRIDAY = 'FRI';
    const EA_SATURDAY = 'SAT';
    // Sunday is an invalid day :-)

    private $BusinessTransitDays;
    private $Time;
    private $PickupDate;
    private $PickupTime;
    private $Date;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            $this->build($response);
            if (isset($response->BusinessTransitDays)) {
                $this->BusinessTransitDays = $response->BusinessTransitDays;
            }
            if (isset($response->Time)) {
                $this->Time = $response->Time;
            }
            if (isset($response->PickupDate)) {
                $this->PickupDate = $response->PickupDate;
            }
            if (isset($response->PickupTime)) {
                $this->PickupTime = $response->PickupTime;
            }
            if (isset($response->Date)) {
                $this->Date = $response->Date;
            }
        }
    }

    /**
     * @return string
     */
    public function getBusinessTransitDays()
    {
        return $this->BusinessTransitDays;
    }

    /**
     * @param string $BusinessTransitDays
     */
    public function setBusinessTransitDays($BusinessTransitDays)
    {
        $this->BusinessTransitDays = $BusinessTransitDays;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->Time;
    }

    /**
     * @param string $Time
     */
    public function setTime($Time)
    {
        $this->Time = $Time;
    }

    /**
     * @return string
     */
    public function getPickupDate()
    {
        return $this->PickupDate;
    }

    /**
     * @param string $PickupDate
     */
    public function setPickupDate($PickupDate)
    {
        $this->PickupDate = $PickupDate;
    }

    /**
     * @return string
     */
    public function getPickupTime()
    {
        return $this->PickupTime;
    }

    /**
     * @param string $PickupTime
     */
    public function setPickupTime($PickupTime)
    {
        $this->PickupTime = $PickupTime;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param string $Date
     */
    public function setDate($Date)
    {
        $this->Date = $Date;
    }
}
