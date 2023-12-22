<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Material;
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
            MaterialSeeder::class,
            BomSeeder::class,
            PlanSeeder::class,
            MotorSeeder::class
        ]);
    }
}
