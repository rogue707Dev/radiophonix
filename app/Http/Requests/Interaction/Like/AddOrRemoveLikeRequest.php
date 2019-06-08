<?php

namespace Radiophonix\Http\Requests\Interaction\Like;

use Illuminate\Foundation\Http\FormRequest;

class AddOrRemoveLikeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => 'required|in:saga',
            'id' => 'required|string',
        ];
    }
}
