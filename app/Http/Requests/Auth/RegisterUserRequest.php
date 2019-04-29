<?php

namespace Radiophonix\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:2|max:40|unique:users,name|alpha_dash',
            'password' => 'required|min:8|max:255',
            'invite' => 'uuid',
        ];
    }

    public function hasInvite(): bool
    {
        return $this->has('invite');
    }
}
