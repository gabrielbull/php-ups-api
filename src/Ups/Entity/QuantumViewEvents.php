<?php
namespace Ups\Entity;

class QuantumViewEvents
{
    public $SubscriberID;
    public $SubscriptionEvents;

    function __construct($response = null)
    {
        $this->SubscriptionEvents = array();

        if (null != $response) {
            if (isset($response->SubscriberID)) {
                $this->SubscriberID = new $response->SubscriberID;
            }
        }
        if (isset($response->SubscriptionEvents)) {
            if (is_array($response->SubscriptionEvents)) {
                foreach ($response->SubscriptionEvents as $SubscriptionEvents) {
                    $this->SubscriptionEvents[] = new SubscriptionEvents($SubscriptionEvents);
                }
            } else {
                $this->SubscriptionEvents[] = new SubscriptionEvents($response->SubscriptionEvents);
            }
        }
    }
} 