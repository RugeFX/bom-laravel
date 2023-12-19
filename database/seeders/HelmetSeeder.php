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
                "master_code" => "MSHLMT",
                "item_code" => "HLM-SIZE-S",
                "name" => "Adult",
                "quantity" => 24,
                "size_id" => 2,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHLMT",
                "item_code" => "HLM-SIZE-M",
                "name" => "Adult",
                "quantity" => 42,
                "size_id" => 3,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHLMT",
                "item_code" => "HLM-SIZE-L",
                "name" => "Adult",
                "quantity" => 12,
                "size_id" => 4,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHLMT",
                "item_code" => "HLM-SIZE-XL",
                "name" => "Adult",
                "quantity" => 21,
                "size_id" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHLMT",
                "item_code" => "HLM-SIZEKDS",
                "name" => "Kids",
                "quantity" => 42,
                "size_id" => 1,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
