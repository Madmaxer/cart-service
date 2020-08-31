<?php

namespace App\Product;

use App\Product\Connector\ConnectorContract;

class ProductService
{
    /**
     * @var ConnectorContract
     */
    private $connector;

    /**
     * @param ConnectorContract $connector
     */
    public function __construct(ConnectorContract $connector)
    {
        $this->connector = $connector;
    }

    public function getProduct(int $productId): Product
    {
        return $this->connector->loadProduct($productId);
    }
}
