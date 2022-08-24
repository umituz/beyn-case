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

    public function create($data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return User::create($data);
            });
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public function getUserById($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                return User::findOrFail($id);
            });
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateUserById($data, User $user)
    {
        try {
            return DB::transaction(function () use ($data, $user) {
                $this->getUserById($user->id)->update($data);
                return $this->getUserById($user->id);
            });
        } catch (\Exception $e) {
            return false;
        }
    }
}
