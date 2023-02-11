<?php

namespace App\Actions\Auth;

use App\Events\OtpRequestReceivedEvent;
use App\Models\User;

class CreateOtpTokenAction
{
    public function execute(User $user)
    {
        event(new OtpRequestReceivedEvent($user));

        return $user;
    }
}
