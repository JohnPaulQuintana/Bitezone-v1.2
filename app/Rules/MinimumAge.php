<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class MinimumAge implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Calculate the minimum allowed date of birth (18 years ago)
        $minimumDateOfBirth = Carbon::now()->subYears(18);
        // Parse the provided date of birth
        $dateOfBirth = Carbon::parse($value);
        // Check if the date of birth is on or before the minimum allowed date
        return $dateOfBirth->lte($minimumDateOfBirth);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // original return
        // return 'The :attribute must be 18 years old and above.';
        return 'Must be 18 years old and above.';
    }
}
