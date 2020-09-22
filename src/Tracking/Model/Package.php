<?php


namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="List of package",
 *     schema="package"
 * )
 */
class Package
{
    /**
     * @var string
     * @OA\Property(
     *     type="string",
     *     property="trackingNumber",
     *     maxLength=34
     * )
     */
    private $trackingNumber;

    /**
     * @var array
     * @OA\Property(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/activity")
     * )
     */
    private $activity;
}
