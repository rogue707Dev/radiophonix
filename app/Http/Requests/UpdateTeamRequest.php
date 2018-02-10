<?php

namespace Radiophonix\Http\Requests;

use Radiophonix\Models\Team;

class UpdateTeamRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Thanks to route model binding we have access to the instance directly
        /** @var Team $team */
        $team = $this->route('team');

        return [
            'name' => 'max:255|unique:teams,name,' . $team->id
        ];
    }
}
