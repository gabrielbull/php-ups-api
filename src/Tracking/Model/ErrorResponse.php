<?php

declare(strict_types=1);

namespace Ups\Tracking\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Error tracking response",
 *     title="Error tracking response",
 *     schema="response"
 * )
 */
class ErrorResponse
{
    /**
     * @var Error[]
     * @OA\Property(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/errors")
     * )
     */
    private $errors;
}
