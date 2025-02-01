<?php

namespace App\Http\Requests;

use App\Enums\EnumStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->route()->getName() == 'products.store' || $this->route()->getName() == 'products.update') {
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
            "image"=>"required|image|mimes:jpeg,jpg,png,gif|max:2048",
            "category_id"=>"required|numeric|exists:categories,id",
            "name"=>"required|string|max:255",
            "description"=>"required|string|max:300",
            "quantity"=>"required|numeric:min:0",
            "price"=>"required|numeric|min:0",
            "status"=>["nullable","string",Rule::in(EnumStatus::values())],
        ];
        if(($this->route()->getName() == 'products.update')) {
            $rules["image"]="nullable|image|mimes:jpeg,jpg,png,gif|max:2048";
        }
        return $rules;
    }
}
