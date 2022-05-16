<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /* FIXME: it's kinda bad to use Factory inside seeder, because seeder is used for some real data upload,
            Factory is used for testing purposes. But for testing purposes seeder and factory in one place
        */
        $this->call(UserSeeder::class);
        Advert::factory()->count(30)->create();
    }
}
