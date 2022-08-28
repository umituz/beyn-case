<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Class BaseTestCase
 * @package Tests\Feature
 */
class BaseTestCase extends TestCase
{
    /**
     * @param $password
     * @return Collection|HasFactory|Model|mixed
     */
    public function createUser($password): mixed
    {
        return User::factory()->create(['password' => Hash::make($password)]);
    }
}
