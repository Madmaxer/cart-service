<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     type="object",
 *     @OA\Property(property="data", ref="#/components/schemas/CartProduct")
 * )
 */
class CartProductResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request): array
    {
        return [
            'product_id' => (int) $this->resource->product_id,
            'product_name' => $this->resource->product_name,
            'product_price' => (float) $this->resource->product_price,
            'product_currency' => $this->resource->product_currency,
            'amount' => (int) $this->resource->amount,
        ];
    }
}
