<?php

namespace Ups\Entity;

use Ups\Entity\RateTimeInTransit\ServiceSummary as RateTimeInTransitServiceSummary;

class RateTimeInTransitResponse
{
    /**
     * @var string
     */
    public $PickupDate;

    /**
     * @var string
     */
    public $DocumentsOnlyIndicator;

    /**
     * @var string
     */
    public $PackageBillType;

    /**
     * @var ServiceSummary
     */
    public $ServiceSummary;

    /**
     * @var string
     */
    public $AutoDutyCode;

    /**
     * @var string
     */
    public $Disclaimer;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->ServiceSummary = [];

        if (null !== $response) {
            if (isset($response->PickupDate)) {
                $this->PickupDate = $response->PickupDate;
            }
            if (isset($response->DocumentsOnlyIndicator)) {
                $this->DocumentsOnlyIndicator = $response->DocumentsOnlyIndicator;
            }
            if (isset($response->AutoDutyCode)) {
                $this->AutoDutyCode = $response->AutoDutyCode;
            }
            if (isset($response->Disclaimer)) {
                $this->Disclaimer = $response->Disclaimer;
            }
            if (isset($response->ServiceSummary)) {
                $this->ServiceSummary = new RateTimeInTransitServiceSummary($response->ServiceSummary);
            }
        }
    }
}
