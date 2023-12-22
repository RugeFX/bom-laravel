<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('motors_master')->insert([
            [
                "master_code" => "MSGNRL",
                "item_code" => "HND-SCOOPY",
                "name" => "Scoopy",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "HND-VARIO-125",
                "name" => "Vario 125",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "HND-VARIO-SurfRack",
                "name" => "Vario Surf-Rack",
                "quantity" => 12,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "HND-VARIO-160",
                "name" => "Vario 160",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "HND-PCX-160",
                "name" => "PCX 160",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "YMH-NMAX",
                "name" => "Nmax",
                "quantity" => 12,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "YMH-NMAX-SurfRack",
                "name" => "Nmax Surf-Rack",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "VSP-LX-125-I-GET",
                "name" => "Vespa LX 125",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "VSP-SPRINT-150-ABS",
                "name" => "Vespa Sprint 150 ABS",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "YMH-XSR",
                "name" => "XSR",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "HND-CRF-150L",
                "name" => "CRF 150L",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "HND-CB-150X",
                "name" => "CB 150X",
                "quantity" => 12,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
