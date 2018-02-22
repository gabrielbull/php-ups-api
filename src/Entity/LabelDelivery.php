<?php

namespace Ups\Entity;

class LabelDelivery
{
    public $LabelLinkIndicator;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->LabelLinkIndicator = null;

        if (null !== $response) {
            if (isset($response->LabelLinkIndicator)) {
                $this->LabelLinkIndicator = true;
            }
        }
    }
}
