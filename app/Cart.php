<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     description="Cart model",
 *     title="Cart model",
 *         @OA\Property(
 *             property="id",
 *             title="Id",
 *             type="integer"
 *         ),
 *         @OA\Property(
 *             property="total_price",
 *             title="Total price",
 *             type="number",
 *             format="float"
 *         ),
 *         @OA\Property(
 *            property="currency",
 *            title="Currency",
 *            type="string"
 *         )
 * )
 *
 * @property integer $id
 * @property float $total_price
 * @property string $currency
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $deleted_at
 */
class Cart extends Model
{
    use SoftDeletes;

    const ATTRIBUTE_ID = 'id';
    const ATTRIBUTE_TOTAL_PRICE = 'total_price';
    const ATTRIBUTE_CURRENCY = 'currency';
    const ATTRIBUTE_CREATED_AT = 'created_at';
    const ATTRIBUTE_UPDATED_AT = 'updated_at';
    const ATTRIBUTE_DELETED_AT = 'deleted_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ATTRIBUTE_TOTAL_PRICE, self::ATTRIBUTE_CURRENCY,
    ];

    public function products(): HasMany
    {
        return $this->hasMany(
            CartProduct::class,
            CartProduct::ATTRIBUTE_CART_ID
        );
    }

    public function getTotalPrice(): float
    {
        return $this->products->sum(function (CartProduct $product) {
            return $product->amount * $product->product_price;
        });
    }
}
