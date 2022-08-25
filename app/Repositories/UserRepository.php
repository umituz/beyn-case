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
        return $this->user->paginate();
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return $this->user->create($data);
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
        return $this->user->findOrFail($id);
    }

    /**
     * @param $data
     * @param User|null $user
     * @return false|mixed
     */
    public function updateUserById($data, ?User $user)
    {
        try {
            return DB::transaction(function () use ($data, $user) {
                $this->getUserById($user->id)->update($data);
                return $this->getUserById($user->id);
            });
        } catch (Exception $e) {
            return false;
        }
    }
}
