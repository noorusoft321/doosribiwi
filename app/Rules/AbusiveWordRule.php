<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AbusiveWordRule implements Rule
{
    public function passes($attribute, $value)
    {
        $abusiveWords = [
            'sex',
            'sexy',
            'fuck',
//            'fcuk',
//            'scam',
            'idiot',
//            'fake',
            'bastard',
            'get lost',
            'fuck',
//            'ass',
            'randi',
//            'bc',
//            'mc',
            'bharwa',
            'bhadwa',
            'dalla',
            'kanjar',
            'chod',
            'kutt',
            'kanjar',
            'chootiya',
        ];
        foreach ($abusiveWords as $word) {
            if (stripos($value, $word) !== false) {
                return false;
            }
        }

//        $pattern = '/^\+[1-9]\d{1,14}$/';
//        return preg_match($pattern, $value);
        return true;
    }

    public function message()
    {
        return 'The :attribute contains abusive words.';
    }
}
