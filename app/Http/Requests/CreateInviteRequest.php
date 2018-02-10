<?php

namespace Radiophonix\Http\Requests;

class CreateInviteRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invited_id' => 'required'
        ];
    }
}
