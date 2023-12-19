<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                "plan_code" => "BKG-PLAN-01",
                "name" => "Kerobokan (QC)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-02",
                "name" => "Kerobokan (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-03",
                "name" => "Seminyak (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-04",
                "name" => "Legian (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-05",
                "name" => "Jimbaran (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-06",
                "name" => "Uluwatu (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-07",
                "name" => "Canggu (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-08",
                "name" => "Lovina (Depot)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-09",
                "name" => "Padang Bai (Depot)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-10",
                "name" => "Sanur (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "plan_code" => "BKG-PLAN-11",
                "name" => "Ubud (Shop)",
                "address" => "-",
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
