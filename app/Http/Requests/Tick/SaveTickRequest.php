<?php

namespace Radiophonix\Http\Requests\Tick;

use Illuminate\Foundation\Http\FormRequest;

class SaveTickRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'progress' => 'required|integer|min:0|max:100000',
        ];
    }
}
