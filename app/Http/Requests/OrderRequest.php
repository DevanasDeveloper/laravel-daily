<?php

namespace App\Http\Requests;

use App\Enums\EnumOrderStatus;
use App\Rules\CustomerExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->route()->getName() == 'orders.store') {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "customer_id"=>["required","numeric",new CustomerExists()],
            "total"=>"required|numeric|min:0",
            "order_items"=>"required|array|min:1",
            "order_items.*.product_id"=>"required|numeric|exists:products,id",
            "order_items.*.price"=>"required|numeric|min:0",
            "order_items.*.quantity"=>"required|numeric|min:1",
            "order_items.*.total"=>"required|numeric|min:0",
            "status"=>["nullable","string",Rule::in(EnumOrderStatus::values())],
        ];
        return $rules;
    }
}
