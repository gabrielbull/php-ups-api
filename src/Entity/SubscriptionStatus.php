<?php

namespace Ups\Entity;

class SubscriptionStatus
{
    public $Code;
    public $Description;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
        }
        if (isset($response->Description)) {
            $this->Description = $response->Description;
        }
    }
}
