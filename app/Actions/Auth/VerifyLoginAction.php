<?php

namespace App\Actions\Auth;

use App\DataTransfers\Auth\VerifyData;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\OtpTokenNotValidException;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class VerifyLoginAction
{
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(VerifyData $data)
    {
        $user = $this->userRepository->findByPhone($data->phone);

        if (!$user) {
            throw (new ModelNotFoundException())->setModel($this->userRepository->model());
        }

        $otpToken = $user->otpTokens()
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpToken) {
            throw new OtpTokenNotValidException($user->id);
        }

        if ($data->code != $otpToken->code) {
            throw new OtpTokenNotValidException($user->id);
        }

        $otpToken->update([
            'expires_at' => now()->subSecond()
        ]);

        $personalAccessToken = $user->createToken('user-auth');
        $user->withAccessToken($personalAccessToken);

        return $user;
    }
}
