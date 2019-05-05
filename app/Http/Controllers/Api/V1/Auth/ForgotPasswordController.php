<?php
declare(strict_types=1);

namespace Radiophonix\Http\Controllers\Api\V1\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Radiophonix\Http\Controllers\Api\V1\ApiController;

class ForgotPasswordController extends ApiController
{
    use SendsPasswordResetEmails;

    public function __invoke(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $this->ok();
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        throw ValidationException::withMessages([
            'email' => trans($response),
        ]);
    }
}
