<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ناديو للـ Seeders اللي وريتهموني توة
        $this->call([
            GaresSeeder::class,
            TrainsSeeder::class,
        ]);
    }
}