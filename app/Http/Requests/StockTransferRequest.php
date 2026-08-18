<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StockTransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "source_warehouse_id" => ['required', 'exists:warehouses,id'],
            "destination_warehouse_id" => ['required', 'exists:warehouses,id'],
            "product_id" => ['required', 'exists:products,id'],
            "quantity" => ['required', 'integer', 'min:1'],
        ];
    }
}
