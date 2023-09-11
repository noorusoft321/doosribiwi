<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Adult implements Rule
{
    public function passes($attribute, $value)
    {
        // Convert the input date to a DateTime object
        $date = \DateTime::createFromFormat('Y-m-d', $value);

        // Calculate the minimum birth date required for being 18 years old
        $minBirthDate = new \DateTime();
        $minBirthDate->sub(new \DateInterval('P18Y'));

        // Compare the input date with the minimum birth date
        return $date <= $minBirthDate;
    }

    public function message()
    {
        return 'You must be at least 18 years old.';
    }
}
