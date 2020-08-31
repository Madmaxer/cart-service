<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     type="object",
 *     @OA\Property(property="data", ref="#/components/schemas/Cart")
 * )
 */
class CartResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request): array
    {
        return [
            'cart_id' => (int) $this->resource->id,
            'total_price' => (float) $this->resource->total_price,
            'details' => CartProductResource::collection($this->resource->products),
        ];
    }
}
