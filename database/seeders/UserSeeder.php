<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'balance' => 99999
        ]);

        User::factory(10)->create();
    }
}
