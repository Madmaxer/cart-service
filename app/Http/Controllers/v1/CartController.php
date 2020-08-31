<?php

namespace App\Http\Controllers\v1;

use App\Cart;
use App\CartProduct;
use App\Http\Requests\AddProductRequest;
use App\Http\Resources\CartResource;
use App\Product\ProductService;
use App\Http\Controllers\v1\Contracts\CartControllerContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CartController implements CartControllerContract
{
    /** @var Cart\CartService */
    private $cartService;

    public function __construct(Cart\CartService $service)
    {
        $this->cartService = $service;
    }

    public function addProduct(
        AddProductRequest $request,
        Cart $cart,
        ProductService $productService
    ): JsonResponse {
        $product = $productService->getProduct($request->getProductId());
        $this->cartService->setCart($cart);

        try {
            $this->cartService->assignProduct($product, $request->getAmount());
        } catch (Cart\Exceptions\ProductLimitReached $exception) {
            Log::info('Cart ['.$cart->id.'] product limit reached');

            /* @todo move to validator */
            $message = ['message' => 'Product name already exists', 'errors' => ['name' => ['Not an unique name']]];

            return response()->json($message, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(null, Response::HTTP_OK);
    }

    public function create(): JsonResource
    {
        $cart = new Cart();
        $cart->total_price = 0;
        $cart->save();

        return new CartResource($cart);
    }

    public function deleteProductFromCart(CartProduct $product): JsonResponse
    {
        $this->cartService->setCart($product->cart);
        $this->cartService->removeProduct($product);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function cart(Cart $cart): JsonResource
    {
        return new CartResource($cart);
    }
}
