<?php

namespace Ups\Tracking;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/details",
 *     summary="Get track activities with an inquiry number",
 *     @OA\Parameter(
 *       name="inquiryNumber",
 *       in="path",
 *       required=true,
 *       @OA\Schema(
 *         type="string",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Success: Everything is working",
 *         @OA\JsonContent(ref="#/components/schemas/trackingResponse")
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="unexpected error",
 *         @OA\Schema(ref="#/components/schemas/response")
 *     )
 * )
 */