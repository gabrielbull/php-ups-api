<?php

namespace Ups\Tracking;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Tracking API",
 *         @OA\Contact(
 *             email="pierre.tondereau@protonmail.com"
 *         ),
 *         @OA\License(
 *             name="MIT"
 *         )
 *     ),
 *     @OA\Server(
 *         description="Production URL",
 *         url="https://onlinetools.ups.com/track/v1"
 *     ),
 *     @OA\Server(
 *         description="Sandbox URL",
 *         url="https://wwwcie.ups.com/track/v1"
 *     ),
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Tracking API",
 *         url="https://www.ups.com/upsdeveloperkit"
 *     )
 * )
 */
