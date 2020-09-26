<?php

declare(strict_types=1);

namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="List of shipment",
 *     schema="shipment"
 * )
 */
class Shipment
{
    /**
     * @var Package[]
     * @OA\Property(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/package")
     * )
     */
    private $package;
}
