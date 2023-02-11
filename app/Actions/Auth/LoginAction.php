<?php

namespace App\Actions\Auth;

use App\DataTransfers\Auth\LoginData;
use App\Repositories\User\UserRepositoryInterface;

class LoginAction
{
    protected UserRepositoryInterface $userRepository;

    protected CreateUserAction $createUserAction;

    protected CreateOtpTokenAction $createOtpTokenAction;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param CreateUserAction $createUserAction
     * @param CreateOtpTokenAction $createOtpTokenAction
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                CreateUserAction $createUserAction,
                                CreateOtpTokenAction $createOtpTokenAction)
    {
        $this->userRepository = $userRepository;
        $this->createUserAction = $createUserAction;
        $this->createOtpTokenAction = $createOtpTokenAction;
    }

    public function execute(LoginData $data)
    {
        $user = $this->userRepository->findByPhone($data->phone);

        if (!$user) {
            $user = $this->createUserAction->execute($data);
        }

        return $this->createOtpTokenAction->execute($user);
    }
}
