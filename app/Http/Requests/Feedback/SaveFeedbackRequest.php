<?php

namespace Radiophonix\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class SaveFeedbackRequest extends FormRequest
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
            'type' => 'required|in:bug,suggestion',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:100000',
            'url' => 'required|url',
        ];
    }
}
