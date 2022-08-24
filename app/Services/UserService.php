<?php

namespace App\Services;

use App\Http\Resources\User\UserCollection;
use App\Repositories\UserRepositoryInterface;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        $users = $this->userRepository->getAll();

        return new UserCollection($users);
    }
}
