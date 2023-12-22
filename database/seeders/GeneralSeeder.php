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
                "item_code" => "ACCS-PH",
                "name" => "Phone Holder",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "master_code" => "MSGNRL",
                "item_code" => "ACCS-KW",
                "name" => "Key Wallets",
                "quantity" => 5,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ]
        ]);
    }
}
