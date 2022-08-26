<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UserBalanceRequest;
use App\Http\Resources\User\UserV2Collection;
use App\Http\Resources\User\UserV2Resource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UsersV2Controller extends ApiController
{
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserV2Collection
     */
    public function index(): UserV2Collection
    {
        $users = $this->userRepository->getAll();

        return new UserV2Collection($users);
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

        return $this->success(__('Success'), UserV2Resource::make($user));
    }
}
