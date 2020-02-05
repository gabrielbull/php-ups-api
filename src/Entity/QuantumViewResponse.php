<?php

namespace Ups\Entity;

class QuantumViewResponse
{
    public $QuantumViewEvents;
    public $Bookmark;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->QuantumViewEvents)) {
                $this->QuantumViewEvents = $response->QuantumViewEvents;
            }
            if (isset($response->Bookmark)) {
                $this->Bookmark = $response->Bookmark;
            }
        }
    }
}
