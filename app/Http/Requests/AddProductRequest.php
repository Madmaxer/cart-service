<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $product_id
 * @property int $amount
 */
class AddProductRequest extends FormRequest
{
    private const FIELD_PRODUCT_ID = 'product_id';
    private const FIELD_AMOUNT = 'amount';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            self::FIELD_PRODUCT_ID => ['required', 'integer'],
            self::FIELD_AMOUNT => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
