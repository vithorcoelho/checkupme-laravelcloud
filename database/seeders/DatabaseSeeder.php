<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SpecialtySeeder::class,
            AgreementSeeder::class,
            UserSeeder::class,
            SubspecialtySeeder::class,

        ]);
    }
}
