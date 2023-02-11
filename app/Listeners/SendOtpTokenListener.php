<?php

namespace App\Listeners;

use App\Events\OtpRequestReceivedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOtpTokenListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OtpRequestReceivedEvent $event
     * @return void
     */
    public function handle(OtpRequestReceivedEvent $event): void
    {
        $user = $event->getUser();
        $otp = $user->otpTokens()->where('expires_at', '>', now())->first();

        $token = rand(100000, 999999);

        if ($otp) {
            $otp->update([
                'code' => $token,
                'expires_at' => now()->addMinutes(2)
            ]);
        } else {
            $otp = $user->otpTokens()->create([
                'code' => $token,
                'expires_at' => now()->addMinutes(2),
            ]);
        }

    }
}
