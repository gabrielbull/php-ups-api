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


    /** @var  \Ups\Entity\Service */
    protected $service;

    /** @var  \Ups\Entity\Guaranteed */
    protected $guaranteed;

    /** @var mixed  */
    protected $saturdayDelivery;

    /** @var mixed  */
    protected $saturdayDeliveryDisclaimer;

    /**
     * @param \stdClass|null $response
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
    }

    /**
     * @return \Ups\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \Ups\Entity\Service $service
     */
    public function setService(Service $service)
    {
      $this->Service = $service;
      $this->service = $service;
    }

    /**
     * @return \Ups\Entity\Guaranteed
     */
    public function getGuaranteed() {
        return $this->guaranteed;
    }

    /**
     * @param \Ups\Entity\Guaranteed $guaranteed
     */
    public function setGuaranteed(Guaranteed $guaranteed) {
        $this->Guaranteed = $guaranteed;
        $this->guaranteed = $guaranteed;
    }

    /**
     * @return mixed
     */
    public function getSaturdayDelivery() {
        return $this->saturdayDelivery;
    }

    /**
     * @param mixed $saturdayDelivery
     */
    public function setSaturdayDelivery($saturdayDelivery) {
        $this->SaturdayDelivery = $saturdayDelivery;
        $this->saturdayDelivery = $saturdayDelivery;
    }

    /**
     * @return mixed
     */
    public function getSaturdayDeliveryDisclaimer() {
        return $this->saturdayDeliveryDisclaimer;
    }

    /**
     * @param mixed $saturdayDeliveryDisclaimer
     */
    public function setSaturdayDeliveryDisclaimer($saturdayDeliveryDisclaimer) {
        $this->SaturdayDeliveryDisclaimer = $saturdayDeliveryDisclaimer;
        $this->saturdayDeliveryDisclaimer = $saturdayDeliveryDisclaimer;
    }

}
