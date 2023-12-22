<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HardcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("hardcases_master")->insert([
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-26",
                "name" => "Hardcase Size 26",
                "quantity" => 18,
                "size_id" => 6,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-30",
                "name" => "Hardcase Size 30",
                "quantity" => 33,
                "size_id" => 7,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-33",
                "name" => "Hardcase Size 33",
                "quantity" => 33,
                "size_id" => 8,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-36",
                "name" => "Hardcase Size 36",
                "quantity" => 33,
                "size_id" => 9,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-38",
                "name" => "Hardcase Size 38",
                "quantity" => 33,
                "size_id" => 10,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-39",
                "name" => "Hardcase Size 39",
                "quantity" => 33,
                "size_id" => 11,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-40",
                "name" => "Hardcase Size 40",
                "quantity" => 33,
                "size_id" => 12,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-41",
                "name" => "Hardcase Size 41",
                "quantity" => 33,
                "size_id" => 13,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-42",
                "name" => "Hardcase Size 42",
                "quantity" => 33,
                "size_id" => 14,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-43",
                "name" => "Hardcase Size 43",
                "quantity" => 33,
                "size_id" => 15,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-44",
                "name" => "Hardcase Size 44",
                "quantity" => 33,
                "size_id" => 16,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "HRCS-SIZE-45",
                "name" => "Hardcase Size 45",
                "quantity" => 33,
                "size_id" => 15,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-26",
                "name" => "Monorack Size 26",
                "quantity" => 18,
                "size_id" => 6,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-30",
                "name" => "Monorack Size 30",
                "quantity" => 33,
                "size_id" => 7,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-33",
                "name" => "Monorack Size 33",
                "quantity" => 33,
                "size_id" => 8,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-36",
                "name" => "Monorack Size 36",
                "quantity" => 33,
                "size_id" => 9,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-38",
                "name" => "Monorack Size 38",
                "quantity" => 33,
                "size_id" => 10,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-39",
                "name" => "Monorack Size 39",
                "quantity" => 33,
                "size_id" => 11,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-40",
                "name" => "Monorack Size 40",
                "quantity" => 33,
                "size_id" => 12,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-41",
                "name" => "Monorack Size 41",
                "quantity" => 33,
                "size_id" => 13,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-42",
                "name" => "Monorack Size 42",
                "quantity" => 33,
                "size_id" => 14,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-43",
                "name" => "Monorack Size 43",
                "quantity" => 33,
                "size_id" => 15,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-44",
                "name" => "Monorack Size 44",
                "quantity" => 33,
                "size_id" => 16,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSHRCS",
                "item_code" => "MNRCK-SIZE-45",
                "name" => "Monorack Size 45",
                "quantity" => 33,
                "size_id" => 15,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);     
    }
}
