<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\NotifiableOnSlack;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    use NotifiableOnSlack;

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
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public function getUserById($id)
    {
        return $this->user->find($id);
    }

    /**
     * @param $data
     * @param $userId
     * @return false|mixed
     */
    public function updateUserById($data, $userId): mixed
    {
        try {
            return DB::transaction(function () use ($data, $userId) {
                $user = $this->getUserById($userId);
                $user->update($data);

                return $user;
            });
        } catch (Exception $e) {
            $this->toSlack(config('slack.channels.db_issues'), $e->getMessage());

            return false;
        }
    }
}
