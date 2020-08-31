<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     description="Cart product model",
 *     title="Cart product model",
 *         @OA\Property(
 *             property="product_id",
 *             title="Product id",
 *             type="integer"
 *         ),
 *         @OA\Property(
 *             property="product_name",
 *             title="Product name",
 *             type="string"
 *         ),
 *         @OA\Property(
 *            property="product_price",
 *            title="Price",
 *            type="string"
 *         ),
 *         @OA\Property(
 *            property="product_currency",
 *            title="Currency",
 *            type="string"
 *         ),
 *         @OA\Property(
 *            property="amount",
 *            title="Amount",
 *            type="integer"
 *         )
 * )
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property string $product_name
 * @property float $product_price
 * @property string $product_currency
 * @property integer $amount
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class CartProduct extends Model
{
    const ATTRIBUTE_ID = 'id';
    const ATTRIBUTE_CART_ID = 'cart_id';
    const ATTRIBUTE_PRODUCT_ID = 'product_id';
    const ATTRIBUTE_PRODUCT_NAME = 'product_name';
    const ATTRIBUTE_PRODUCT_PRICE = 'product_price';
    const ATTRIBUTE_PRODUCT_CURRENCY = 'product_currency';
    const ATTRIBUTE_AMOUNT = 'amount';
    const ATTRIBUTE_CREATED_AT = 'created_at';
    const ATTRIBUTE_UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ATTRIBUTE_CART_ID,
        self::ATTRIBUTE_PRODUCT_ID,
        self::ATTRIBUTE_PRODUCT_NAME,
        self::ATTRIBUTE_PRODUCT_PRICE,
        self::ATTRIBUTE_PRODUCT_CURRENCY,
        self::ATTRIBUTE_AMOUNT,
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, self::ATTRIBUTE_CART_ID);
    }
}
