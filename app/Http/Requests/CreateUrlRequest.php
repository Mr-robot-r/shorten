<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUrlRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: Check User Has "Area Create" Permission
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => [
                'required',
                'string',
            ],
        ];
    }
}