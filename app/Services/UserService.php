<?php

namespace App\Services;

use App\Http\Resources\User\UserCollection;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;
    private ?\Illuminate\Contracts\Auth\Authenticatable $user;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->user = Auth::user();
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        $users = $this->userRepository->getAll();

        return new UserCollection($users);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateUserBalance($request): mixed
    {
        $user = $this->userRepository->updateUserById(
            ['balance' => $this->user->balance ?? 1 + $request->amount],
            $this->user
        );

        if (!$user) {
            return $this->error(__('Could not add balance'));
        }

        return $this->success(__('Success'), new UserCollection($user));
    }
}
