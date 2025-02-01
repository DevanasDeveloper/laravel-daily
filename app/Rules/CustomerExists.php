<?php

namespace App\Rules;

use App\Enums\EnumRole;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CustomerExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!User::where('id', $value)->where('role', EnumRole::CUSTOMER->value)->exists()){
            $fail('The selected customer id is invalid.');
        }
       
    }


}
