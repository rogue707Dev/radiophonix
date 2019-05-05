<?php
declare(strict_types=1);

namespace Radiophonix\Http\Controllers\Api\V1\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;

class ResetPasswordController extends ApiController
{
    use ResetsPasswords;

    public function __invoke(Request $request)
    {
        return $this->reset($request);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return $this->ok();
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        throw ValidationException::withMessages([
            'email' => trans($response),
        ]);
    }
}
