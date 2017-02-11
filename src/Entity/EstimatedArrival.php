<?php

namespace Ups\Entity;

class EstimatedArrival extends Rate\EstimatedArrival
{
    const EA_MONDAY = 'MON';
    const EA_TUESDAY = 'TUE';
    const EA_WEDNESDAY = 'WEB';
    const EA_THUSDAY = 'THU';
    const EA_FRIDAY = 'FRI';
    const EA_SATURDAY = 'SAT';
    // Sunday is an invalid day :-)

    private $Time;
    private $PickupDate;
    private $PickupTime;
    private $DelayCount;
    private $Date;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        parent::__construct($response);

        if (null !== $response) {
            if (isset($response->Time)) {
                $this->Time = $response->Time;
            }
            if (isset($response->PickupDate)) {
                $this->PickupDate = $response->PickupDate;
            }
            if (isset($response->PickupTime)) {
                $this->PickupTime = $response->PickupTime;
            }
            if (isset($response->DelayCount)) {
                $this->DelayCount = $response->DelayCount;
            }
            if (isset($response->Date)) {
                $this->Date = $response->Date;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->Time;
    }

    /**
     * @param mixed $Time
     */
    public function setTime($Time)
    {
        $this->Time = $Time;
    }

    /**
     * @return mixed
     */
    public function getPickupDate()
    {
        return $this->PickupDate;
    }

    /**
     * @param mixed $PickupDate
     */
    public function setPickupDate($PickupDate)
    {
        $this->PickupDate = $PickupDate;
    }

    /**
     * @return mixed
     */
    public function getPickupTime()
    {
        return $this->PickupTime;
    }

    /**
     * @param mixed $PickupTime
     */
    public function setPickupTime($PickupTime)
    {
        $this->PickupTime = $PickupTime;
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
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date)
    {
        $this->Date = $Date;
    }

}
