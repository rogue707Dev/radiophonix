<?php

namespace Radiophonix\Http\Requests;

use Radiophonix\Models\Saga;

class UpdateSagaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Thanks to route model binding we have access to the instance directly
        /** @var Saga $saga */
        $saga = $this->route('saga');

        return [
            'name' => 'required|max:255|unique:sagas,name,' . $saga->id,
            'finished' => 'boolean',
            'creation_date' => 'date_format:Y-m-d'
        ];
    }
}
