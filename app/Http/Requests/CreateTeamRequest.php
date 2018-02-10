<?php

namespace Radiophonix\Http\Requests;

class CreateTeamRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:teams'
        ];
    }
}
