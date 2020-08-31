<?php

namespace App\Http\Controllers\General\Contracts;

use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="healthcheck",
 * )
 */
interface HealthCheckControllerContract
{
    /**
     * @OA\Get(
     *     path="/health",
     *     tags={"healthcheck"},
     *     summary="Health",
     *     operationId="health",
     *     @OA\Response(response=200, description="Empty response"),
     * )
     */
    public function health(): JsonResponse;

    /**
     * @OA\Get(
     *     path="/heartbeat",
     *     tags={"healthcheck"},
     *     summary="Heartbeat",
     *     operationId="heartbeat",
     *      @OA\Response(response=200, description="Empty response"),
     * )
     */
    public function heartbeat(): JsonResponse;

    /**
     * @OA\Get(
     *     path="/version",
     *     tags={"healthcheck"},
     *     summary="Version",
     *     description="Returns app version",
     *     operationId="version",
     *      @OA\Response(response=200, description="Returns app version"),
     * )
     */
    public function version(): JsonResponse;
}
