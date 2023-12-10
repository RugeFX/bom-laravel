<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("medicines_master")->insert([
            [
                "master_id" => 2,
                "item_code" => "MDCBNDG",
                "name" => "Bandage",
                "quantity" => 50,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_id" => 2,
                "item_code" => "MDCSCSR",
                "name" => "Scissors",
                "quantity" => 50,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_id" => 2,
                "item_code" => "MDCTHRM",
                "name" => "Thermometer",
                "quantity" => 50,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_id" => 2,
                "item_code" => "MDCTWZR",
                "name" => "Tweezer",
                "quantity" => 50,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
