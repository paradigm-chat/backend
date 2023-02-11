<?php

namespace App\Actions\Auth;

use App\DataTransfers\Auth\LoginData;
use App\Repositories\User\UserRepositoryInterface;

class CreateUserAction
{
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(LoginData $data)
    {
        return $this->userRepository->create([
            'phone' => $data->phone,
        ]);
    }
}
