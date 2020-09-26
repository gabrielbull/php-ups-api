<?php

declare(strict_types=1);

namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Location",
 *     schema="location"
 * )
 */
class Location
{
    /**
     * @var Address
     * @OA\Property(
     *     type="object",
     *     ref="#/components/schemas/address"
     * )
     */
    private $address;
}
