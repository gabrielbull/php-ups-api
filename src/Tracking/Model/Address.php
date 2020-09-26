<?php

declare(strict_types=1);

namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Address",
 *     schema="address"
 * )
 */
class Address
{
    /**
     * @var string
     * @OA\Property(
     *     type="string",
     *     description="Postal code of state or province (if applicable)",
     *     example="55555",
     *     property="postalCode"
     * )
     */
    private $postalCode;

    /**
     * @var string
     * @OA\Property(
     *     type="string",
     *     property="stateProvince",
     *     description="State or Province name"
     * )
     */
    private $stateProvince;

    /**
     * @var string
     * @OA\Property(
     *     type="string",
     *     maxLength=50,
     *     property="city",
     *     description="City name"
     * )
     */
    private $city;

    /**
     * @var string
     * @OA\Property(
     *     type="string",
     *     maxLength=2,
     *     property="countryCode",
     *     description="Two digit country code.",
     *     example="US"
     * )
     */
    private $countryCode;
}
