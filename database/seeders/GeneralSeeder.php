<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generals_master')->insert([
            [
                "master_code" => "MSGNRL",
                "item_code" => "MTRPCX",
                "name" => "PCX",
                "quantity" => 5,
                "color_id" => 1,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "MTRNMX",
                "name" => "NMAX",
                "quantity" => 5,
                "color_id" => 2,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "MTRSCP",
                "name" => "SCOOPY",
                "quantity" => 12,
                "color_id" => 3,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
