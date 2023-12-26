<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuitemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("menuitems")->insert([
            [
                "code" => "1",
                "name" => "Dashboard",
                "url" => "-",
                "menugroup_code" => "1",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "2",
                "name" => "Category",
                "url" => "-",
                "menugroup_code" => "2",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "3",
                "name" => "Master",
                "url" => "-",
                "menugroup_code" => "2",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "4",
                "name" => "Size",
                "url" => "-",
                "menugroup_code" => "2",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "5",
                "name" => "Color",
                "url" => "-",
                "menugroup_code" => "2",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "6",
                "name" => "Material",
                "url" => "-",
                "menugroup_code" => "2",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "7",
                "name" => "Helmet",
                "url" => "-",
                "menugroup_code" => "3",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "8",
                "name" => "Hardcase",
                "url" => "-",
                "menugroup_code" => "3",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "9",
                "name" => "General",
                "url" => "-",
                "menugroup_code" => "3",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "10",
                "name" => "Motor",
                "url" => "-",
                "menugroup_code" => "3",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "11",
                "name" => "Fak",
                "url" => "-",
                "menugroup_code" => "3",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "12",
                "name" => "Reservation",
                "url" => "-",
                "menugroup_code" => "4",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "13",
                "name" => "MenuItem",
                "url" => "-",
                "menugroup_code" => "5",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "14",
                "name" => "MenuGroup",
                "url" => "-",
                "menugroup_code" => "5",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "15",
                "name" => "Role",
                "url" => "-",
                "menugroup_code" => "5",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "16",
                "name" => "Staff",
                "url" => "-",
                "menugroup_code" => "5",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
            [
                "code" => "17",
                "name" => "User",
                "url" => "-",
                "menugroup_code" => "5",
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ],
        ]);
    }
}
