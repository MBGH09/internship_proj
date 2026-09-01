<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Exécute les seeders
    public function run(): void
    {
        // Appelle les seeders dans l'ordre
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            EventSeeder::class,
        ]);
    }
}