<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\User\BalanceRequest;
use App\Http\Resources\User\UserV1Resource;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;

/**
 * Class UsersV1Controller
 * @package App\Http\Controllers\Api\User
 */
class UsersV1Controller extends ApiController
{
    private $user;
    private UserRepositoryInterface $userRepository;
    private UserService $userService;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, UserService $userService)
    {
        $this->user = request()->user();
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * @return UserV1Resource
     */
    public function profile(): UserV1Resource
    {
        return new UserV1Resource($this->user);
    }

    /**
     * @param BalanceRequest $request
     * @return mixed
     */
    public function balance(BalanceRequest $request): mixed
    {
        $user = $this->userRepository->updateUserById(
            ['balance' => $this->userService->getBalanceByType($this->user->balance, $request->amount, $request->type)],
            $this->user->id,
        );

        return $this->success(__('Success'), UserV1Resource::make($user));
    }
}
