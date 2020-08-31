<?php

namespace App\Http\Controllers\v1\Contracts;

use App\Cart;
use App\CartProduct;
use App\Http\Requests\AddProductRequest;
use App\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Tag(
 *     name="carts",
 * )
 */
interface CartControllerContract
{
    /**
     * @OA\Post(
     *     path="/api/v1/cart",
     *     tags={"carts"},
     *     summary="Create a cart",
     *     description="Returns a created cart",
     *     operationId="cart",
     *     @OA\Response(response=200, description="Returns a created cart"),
     * )
     */
    public function create(): JsonResource;

    /**
     * @OA\Patch(
     *     path="/api/v1/cart/{cartId}",
     *     tags={"carts"},
     *     summary="Updates a cart",
     *     operationId="updateCart",
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         example="application/json",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="Content-Type",
     *         in="header",
     *         required=true,
     *         example="application/json",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="cartId",
     *         in="path",
     *         description="ID of cart that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="product_id",
     *                 type="integer",
     *             ),
     *             @OA\Property(
     *                 property="amount",
     *                 type="integer",
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response=200, description="Success", @OA\JsonContent(ref="#/components/schemas/Cart")),
     *     @OA\Response(response=404, description="Cart not found"),
     *     @OA\Response(response=406, description="Not Acceptable"),
     *     @OA\Response(response=415, description="Unsupported Media Type")
     * )
     */
    public function addProduct(AddProductRequest $request, Cart $cart, ProductService $productService): JsonResponse;

    /**
     * @OA\Delete(
     *     path="/api/v1/product/{productId}",
     *     tags={"carts"},
     *     summary="Deletes a product from a cart",
     *     operationId="deleteProductFromCart",
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         example="application/json",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="productId",
     *         in="path",
     *         description="Product id to delete from a cart",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(response=204, description="Success, no content", @OA\JsonContent()),
     *     @OA\Response(response=404, description="Product not found"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=406, description="Not Acceptable")
     * )
     */
    public function deleteProductFromCart(CartProduct $product): JsonResponse;

    /**
     * @OA\Get(
     *     path="/api/v1/cart/{cartId}",
     *     tags={"carts"},
     *     summary="Returns a cart",
     *     operationId="readCart",
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         example="application/json",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="cartId",
     *         in="path",
     *         description="ID of cart to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Cart"),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Invalid product"
     *     ),
     *     @OA\Response(response=406, description="Not Acceptable")
     * )
     */
    public function cart(Cart $cart): JsonResource;
}
