<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenugroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("menugroups")->insert([
            [
                "code" => "1",
                "name" => "Home",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "2",
                "name" => "Master",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "3",
                "name" => "Item",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "4",
                "name" => "Reservation",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "5",
                "name" => "Admin Panel",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
