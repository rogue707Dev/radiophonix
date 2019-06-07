<?php

namespace Radiophonix\Http\Requests\Interaction\Site;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPageViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'path' => 'required|string',
        ];
    }
}
