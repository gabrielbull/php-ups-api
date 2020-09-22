<?php

namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Tracking response",
 *     title="Tracking response",
 *     schema="trackingResponse"
 * )
 */
class TrackingResponse
{
    /**
     * @var Shipment[]
     * @OA\Property(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/shipment")
     * )
     */
    private $shipment;

}