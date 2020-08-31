<?php

namespace App\Product;

class Product
{
    /**
     * @var int
     */
    protected $productId;

    /**
     * @var string
     */
    protected $productName;

    /**
     * @var float
     */
    protected $productPrice;

    /**
     * @var string
     */
    protected $productCurrency;

    /**
     * @param int $productId
     * @param string $productName
     * @param float $productPrice
     * @param string $productCurrency
     */
    public function __construct(
        int $productId,
        string $productName,
        float $productPrice,
        string $productCurrency
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productCurrency = $productCurrency;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return float
     */
    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    /**
     * @return string
     */
    public function getProductCurrency(): string
    {
        return $this->productCurrency;
    }
}
