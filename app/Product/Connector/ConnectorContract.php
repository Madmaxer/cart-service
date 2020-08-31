<?php

namespace App\Product\Connector;

use App\Product\Exceptions\LoadProductFailed;
use App\Product\Product;

interface ConnectorContract
{
    /**
     * @param int $productId
     *
     * @return Product
     *
     * @throws LoadProductFailed
     */
    public function loadProduct(int $productId): Product;
}
