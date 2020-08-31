<?php

namespace App\Product\Connector;

use App\Product\Exceptions\LoadProductFailed;
use App\Product\Product;

/**
 * @package App\MockConnector
 */
class MockConnector implements ConnectorContract
{
    /** @var array */
    private $products = [
        1 => [
            'id' => 1,
            'name' => 'test',
            'price' => 1.99,
            'currency' => 'USD',
        ]
    ];

    /**
     * @inheritdoc
     */
    public function loadProduct(int $productId): Product
    {
        if (isset($this->products[$productId])) {
            return new Product(
                $this->products[$productId]['id'],
                $this->products[$productId]['name'],
                $this->products[$productId]['price'],
                $this->products[$productId]['currency']
            );
        }

        throw new LoadProductFailed('Unauthenticated');
    }
}
