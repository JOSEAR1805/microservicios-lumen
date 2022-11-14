<?php

namespace Database\Seeders;

// use App\Models\Author;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // comando: php artisan db:seed
    // php artisan migrate:fresh --seed -> para que borre la estructura de la base de datos e inserte el registro

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Author::factory()
        //     ->count(50)
        //     ->create();
        \App\Models\Author::factory()->count(30)->create(); 

    }
}
