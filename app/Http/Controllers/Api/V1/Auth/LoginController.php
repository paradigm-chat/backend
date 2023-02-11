<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\VerifyLoginAction;
use App\Exceptions\OtpTokenNotValidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\VerifyRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginAction $action)
    {
        $data = $request->validated();

        try {
            $user = $action->execute($data);
        } catch (\Exception $exception) {
            return apiResponse(false, 'otp.already.exists');
        }

        return apiResponse(true, ['success']);
    }

    public function verify(VerifyRequest $request, VerifyLoginAction $action)
    {
        try {
            $user = $action->execute($request->validated());
        } catch (OtpTokenNotValidException $exception) {
            return apiResponse(false, ['otp.not_valid']);
        }

        return apiResponse(true, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'token' => $user->currentAccessToken()->plainTextToken,
        ]);
    }
}
