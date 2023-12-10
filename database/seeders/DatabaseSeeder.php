<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            MasterSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            GeneralSeeder::class,
            HardcaseSeeder::class,
            HelmetSeeder::class,
            MedicineSeeder::class,
            MaterialMasterSeeder::class
        ]);
    }
}
