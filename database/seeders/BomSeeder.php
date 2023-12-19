<?php

namespace Database\Seeders;

use App\Models\Bom;
use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bom1 = Bom::create(["bom_code" => "BKG-HLM-SIZE-S"]);
        $material1 = Material::where('item_code', 'HLM-SIZE-S')->first();
        $bom1->material()->attach($material1);

        $bom2 = Bom::create(["bom_code" => "BKG-HLM-SIZE-M"]);
        $material1 = Material::where('item_code', 'HLM-SIZE-M')->first();
        $bom2->material()->attach($material1);

        $bom3 = Bom::create(["bom_code" => "BKG-HLM-SIZE-L"]);
        $material1 = Material::where('item_code', 'HLM-SIZE-L')->first();
        $bom3->material()->attach($material1);

        $bom4 = Bom::create(["bom_code" => "BKG-HLM-SIZE-XL"]);
        $material1 = Material::where('item_code', 'HLM-SIZE-XL')->first();
        $bom4->material()->attach($material1);

        $bom5 = Bom::create(["bom_code" => "BKG-FAK-NEW"]);
        $material1 = Material::where('item_code', 'FAK-NEW')->first();
        $bom5->material()->attach($material1);

        // $bom2 = Bom::create(["bom_code" => "BOM_0002"]);
        // $material2 = Material::where('item_code', 'HRCS-SIZE-38')->first();
        // $material3 = Material::where('item_code', 'YMH-NMAX')->first();
        // $bom2->material()->sync([$material2->item_code, $material3->item_code]);
    }
}
