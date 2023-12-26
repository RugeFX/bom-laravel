<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "staff_code" => "BKG-STAFF-0001",
                "password" => bcrypt("super123"),
                "username" => "SuperAdmin",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
