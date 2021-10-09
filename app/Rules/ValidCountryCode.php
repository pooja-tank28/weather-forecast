<?php

namespace App\Rules;

use App\Helpers\CountryHelper;
use Illuminate\Contracts\Validation\Rule;

class ValidCountryCode implements Rule
{


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true === CountryHelper::validateCountryCode($value);
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The provided country code is invalid. Country codes must be valid alpha-2 code.';
    }
}
