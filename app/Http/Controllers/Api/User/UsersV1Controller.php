<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserBalanceRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UsersV1Controller extends ApiController
{
    private UserRepositoryInterface $userRepository;
    private UserService $userService;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserService $userService
    )
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        return $this->userService->getList();
    }

    /**
     * @param UserBalanceRequest $request
     * @return mixed
     */
    public function addBalance(UserBalanceRequest $request): mixed
    {
        $user = Auth::user();
        $user = $this->userRepository->updateUserById(
            ['balance' => $user->balance + $request->amount],
            $user
        );

        if (!$user) {
            return $this->error(__('Could not add balance'));
        }

        return $this->success(__('Success'), UserResource::make($user));
    }
}
