<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('masters')->insert([
            [
                "code" => "MSHLMT",
                "category_id" => 1,
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "code" => "MSMDCN",
                "category_id" => 2,
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "code" => "MSGNRL",
                "category_id" => 1,
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                "code" => "MSHRCS",
                "category_id" => 3,
                "created_at" =>  \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
