<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserBalanceV1Request;
use App\Http\Resources\User\UserV1Collection;
use App\Http\Resources\User\UserV1Resource;
use App\Repositories\UserRepositoryInterface;

class UsersV1Controller extends ApiController
{
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserV1Collection
     */
    public function index(): UserV1Collection
    {
        $users = $this->userRepository->getAll();

        return new UserV1Collection($users);
    }

    /**
     * @param UserBalanceV1Request $request
     * @return mixed
     */
    public function addBalance(UserBalanceV1Request $request): mixed
    {
        $user = $request->user();
        $user = $this->userRepository->updateUserById(
            ['balance' => $user->balance + $request->amount],
            $user->id,
        );

        if (!$user) {
            return $this->error(__('Could not add balance'));
        }

        return $this->success(__('Success'), UserV1Resource::make($user));
    }
}
