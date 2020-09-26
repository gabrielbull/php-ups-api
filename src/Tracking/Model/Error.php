<?php

declare(strict_types=1);

namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="List of errors tracking response",
 *     schema="errors"
 * )
 */
class Error
{
    /**
     * @var string
     * @OA\Property(type="string")
     */
    private $code;

    /**
     * @var string
     * @OA\Property(type="string")
     */
    private $message;
}
