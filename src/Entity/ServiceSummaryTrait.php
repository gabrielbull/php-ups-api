<?php

namespace Ups\Entity;

trait ServiceSummaryTrait
{
    /** @deprecated */
    public $Service;

    /** @deprecated */
    public $Guaranteed;

    /** @deprecated */
    public $SaturdayDelivery;

    /** @deprecated */
    public $SaturdayDeliveryDisclaimer;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @var Guaranteed
     */
    protected $guaranteed;

    /** @var mixed  */
    protected $saturdayDelivery;

    /** @var mixed  */
    protected $saturdayDeliveryDisclaimer;

    /**
     * @param \stdClass|null $response
     * @return static
     */
    public function build(\stdClass $response = null)
    {
        $this->setService(new Service());
        $this->setGuaranteed(new Guaranteed());

        if (null !== $response) {
            if (isset($response->Service)) {
                $this->setService(new Service($response->Service));
            }
            if (isset($response->Guaranteed)) {
                $this->setGuaranteed(new Guaranteed($response->Guaranteed));
            }
        }

        return $this;
    }

    /**
     * @return Service|null
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     * @return static
     */
    public function setService(Service $service)
    {
        $this->Service = $service;
        $this->service = $service;

        return $this;
    }

    /**
     * @return Guaranteed|null
     */
    public function getGuaranteed()
    {
        return $this->guaranteed;
    }

    /**
     * @param $guaranteed
     * @return static
     */
    public function setGuaranteed(Guaranteed $guaranteed)
    {
        $this->Guaranteed = $guaranteed;
        $this->guaranteed = $guaranteed;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaturdayDelivery()
    {
        return $this->saturdayDelivery;
    }

    /**
     * @param mixed $saturdayDelivery
     * @return static
     */
    public function setSaturdayDelivery($saturdayDelivery)
    {
        $this->SaturdayDelivery = $saturdayDelivery;
        $this->saturdayDelivery = $saturdayDelivery;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaturdayDeliveryDisclaimer()
    {
        return $this->saturdayDeliveryDisclaimer;
    }

    /**
     * @param mixed $saturdayDeliveryDisclaimer
     * @return static
     */
    public function setSaturdayDeliveryDisclaimer($saturdayDeliveryDisclaimer)
    {
        $this->SaturdayDeliveryDisclaimer = $saturdayDeliveryDisclaimer;
        $this->saturdayDeliveryDisclaimer = $saturdayDeliveryDisclaimer;

        return $this;
    }
}
