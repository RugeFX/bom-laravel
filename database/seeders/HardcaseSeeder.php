<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class HardcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("hardcases_master")->insert([
            [
                "master_id" => 4,
                "item_code" => "HCS001",
                "name" => "Hardcase 1",
                "quantity" => 18,
                "color_id" => 1,
                "size_id" => 4,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_id" => 4,
                "item_code" => "HCS002",
                "name" => "Hardcase 2",
                "quantity" => 33,
                "color_id" => 2,
                "size_id" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);     
    }
}
