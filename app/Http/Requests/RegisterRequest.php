<?php

namespace App\Http\Requests;

use App\Enums\EnumRole;
use App\Enums\EnumStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
            if($this->route()->getName() == 'register' && $this->route()->getPrefix() == 'api'){
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
        return [
            "fullname"=>"required|string|max:255",
            "email"=>"required|string|email|max:255|unique:users,email",
            "phone"=>"required|string|max:255",
            "address"=>"required|string|max:255",
            "password"=>"required|string|max:255",
            "password_confirmation"=>"required|string|max:255|same:password",
            "role"=>["nullable","string",Rule::in(EnumRole::values())],
            "status"=>["nullable","string",Rule::in(EnumStatus::values())],
        ];
    }
}
