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
        User::insert([
            [
                'id' => 1,
                'name' => 'First User',
                'email' => 'user_1@example.com',
                'password' => bcrypt('password_1')
            ],
            [
                'id' => 2,
                'name' => 'Second User',
                'email' => 'user_2@example.com',
                'password' => bcrypt('password_2')
            ]
        ]);
    }
}
