<?php
namespace Ups\Entity;

class QuantumViewResponse
{
    public $QuantumViewEvents;
    public $Bookmark;

    function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->QuantumViewEvents)) {
                $this->QuantumViewEvents = $response->QuantumViewEvents;
            }
            if (isset($response->Bookmark)) {
                $this->Bookmark = $response->Bookmark;
            }

        }
    }

} 