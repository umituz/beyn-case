<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ümit UZ',
            'email' => 'umituz998@gmail.com',
            'password' => bcrypt(123456789),
            'balance' => 100
        ]);
        User::factory(9)->create();
    }
}
