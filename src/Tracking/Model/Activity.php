<?php

declare(strict_types=1);

namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="List of activity",
 *     schema="activity"
 * )
 */
class Activity
{
    /**
     * @var Location
     * @OA\Property(
     *     type="object",
     *     ref="#/components/schemas/location"
     * )
     */
    private $location;
}
