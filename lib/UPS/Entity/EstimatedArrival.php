<?php

namespace UPS\Entity;


class EstimatedArrival {
    public $BusinessTransitDays;
    public $Time;
    public $PickupDate;
    public $PickupTime;
    public $HolidayCount;
    public $DelayCount;
    public $Date;
    public $DayOfWeek;
    public $TotalTransitDays;
    public $CustomerCenterCutoff;
    public $RestDays;

    function __construct() {
    }
} 