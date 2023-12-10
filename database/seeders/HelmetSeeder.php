<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HelmetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("helmets_master")->insert([
            [
                "master_id" => 1,
                "item_code" => "HLMADLT",
                "name" => "Adult",
                "quantity" => 26,
                "size_id" => 2,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_id" => 1,
                "item_code" => "HLMKIDS",
                "name" => "Kids",
                "quantity" => 42,
                "size_id" => 1,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
