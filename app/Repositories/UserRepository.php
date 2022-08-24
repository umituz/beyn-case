<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return false|mixed
     */
    public function getAll(): mixed
    {
        try {
            return DB::transaction(function () {
                return User::paginate();
            });
        } catch (Exception $e) {
            return false;
        }
    }
}
