<?php

namespace App\Exceptions;

use Exception;

class OtpTokenNotValidException extends Exception
{
    public function render($request)
    {
        return apiResponse(false, ['otp.not_valid']);
    }
}
