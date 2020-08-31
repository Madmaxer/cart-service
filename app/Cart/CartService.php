<?php

namespace App\Cart;

use App\Cart;
use App\CartProduct;
use App\Product\Product;

class CartService
{
    /**
     * @var Cart
     */
    private $cart;

    public function setCart(Cart $cart): void
    {
        $this->cart = $cart;
    }

    /**
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->cart;
    }

    /**
     * @param Product $productData
     * @param int $amount
     * @throws Exceptions\ProductLimitReached
     */
    public function assignProduct(Product $productData, int $amount = 1): void
    {
        if ($this->cart->products->count() >= 3) {
            throw new Cart\Exceptions\ProductLimitReached();
        }

        $this->assignProductToCart($productData, $amount);

        $this->updateTotalPrice();
    }

    public function removeProduct(CartProduct $product): void
    {
        $product->delete();

        $this->updateTotalPrice();
    }

    private function assignProductToCart(Product $productData, int $amount): void
    {
        $cartProduct = CartProduct::where(['cart_id' => $this->cart->id, 'product_id' => $productData->getProductId()])
            ->first();

        if (!$cartProduct) {
            $cartProduct = new CartProduct();
        }

        $cartProduct->product_id = $productData->getProductId();
        $cartProduct->product_name = $productData->getProductName();
        $cartProduct->product_price = $productData->getProductPrice();
        $cartProduct->product_currency = $productData->getProductCurrency();
        $cartProduct->amount = $amount;

        $this->cart->products()->save($cartProduct);
    }

    private function updateTotalPrice(): void
    {
        $this->cart->refresh();
        $this->cart->total_price = $this->cart->getTotalPrice();

        $this->cart->save();
    }
}
