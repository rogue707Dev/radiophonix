<?php

namespace Radiophonix\Http\Requests;

class TickRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seconds' => 'required|integer'
        ];
    }
}
