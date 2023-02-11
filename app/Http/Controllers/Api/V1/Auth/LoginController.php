<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;

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
}
