<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:55'],
            'balance' => ['required', 'decimal:2', 'between:0,9999.99'],
        ];
    }
}
