<?php

namespace App\Http\Requests;

use App\Enums\EnumStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->route()->getName() == 'customers.store' || $this->route()->getName() == 'customers.update') {
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
            "fullname"=>"required|string|max:255",
            "email"=>"required|string|email|max:255|unique:users,email",
            "phone"=>"required|string|max:255",
            "address"=>"required|string|max:255",
            "password"=>"required|string|max:255",
            "status"=>["nullable","string",Rule::in(EnumStatus::values())],
        ];
        if($this->route()->getName() == 'customers.update') {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,'.$this->id;
        }
        return $rules;
    }
}
