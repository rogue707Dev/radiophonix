<?php

namespace Radiophonix\Http\Requests;

class CreateSagaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // When creating a saga, only the name is mandatory
            'name' => 'required|max:255|unique:sagas|not_in:saga,sagas,login,logout,register,albums,author,likes'
        ];
    }
}
