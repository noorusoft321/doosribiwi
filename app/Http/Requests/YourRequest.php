<?php

namespace App\Http\Requests;
use App\Rules\AbusiveWordRule;
use Illuminate\Foundation\Http\FormRequest;

class YourRequest extends FormRequest
{
    public function rules()
    {
        return [
            'message' => ['required', new AbusiveWordRule()]
        ];
    }
}
