<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserBalanceV1Request;
use App\Http\Resources\User\UserV1Resource;
use App\Repositories\UserRepositoryInterface;

/**
 * Class UsersV1Controller
 * @package App\Http\Controllers\Api\User
 */
class UsersV1Controller extends ApiController
{
    private UserRepositoryInterface $userRepository;
    private $user;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->user = request()->user();
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserV1Resource
     */
    public function profile(): UserV1Resource
    {
        return new UserV1Resource($this->user);
    }

    /**
     * @param UserBalanceV1Request $request
     * @return mixed
     */
    public function balance(UserBalanceV1Request $request): mixed
    {
        $user = $this->userRepository->updateUserById(
            ['balance' => $this->user->balance + $request->amount],
            $this->user->id,
        );

        if (!$user) {
            return $this->error(__('Could not add balance'));
        }

        return $this->success(__('Success'), UserV1Resource::make($user));
    }
}
