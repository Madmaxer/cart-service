<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="Cart Swagger Documentation",
 *     version="0.0.1",
 *     title="cart-service"
 * )
 *
 * @OA\Schema(
 *     schema="ValidationErrors",
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             example="The given data was invalid.",
 *         ),
 *         @OA\Property(
 *             property="errors",
 *             type="object",
 *                 @OA\Property(
 *                     property="parameter",
 *                     type="array",
 *                     description="Key: request parameter name, value: array of parameter validation errors.",
 *                     @OA\Items(
 *                         example="[The order details field is required.]",
 *                     )
 *                 ),
 *         ),
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
