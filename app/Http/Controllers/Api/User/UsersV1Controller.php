<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\User\BalanceRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;

/**
 * Class UsersV1Controller
 * @package App\Http\Controllers\Api\User
 */
class UsersV1Controller extends ApiController
{
    private $user;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserService $userService
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected UserService $userService)
    {
        $this->user = request()->user();
    }

    /**
     * @return UserResource
     */
    public function profile(): UserResource
    {
        return new UserResource($this->user);
    }

    /**
     * @param BalanceRequest $request
     * @return mixed
     */
    public function balance(BalanceRequest $request): mixed
    {
        $balance = $this->userService->getBalanceByType($this->user->balance, $request->amount, $request->type);

        $user = $this->userRepository->updateUserById(
            ['balance' => $balance],
            $this->user->id,
        );

        return $this->success(__('Success'), UserResource::make($user));
    }
}
