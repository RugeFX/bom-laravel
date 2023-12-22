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

        $bom5 = Bom::create(["bom_code" => "BKG-ACCS-PH"]);
        $material1 = Material::where('item_code', 'ACCS-PH')->first();
        $bom5->material()->attach($material1);

        $bom5 = Bom::create(["bom_code" => "BKG-ACCS-KW"]);
        $material1 = Material::where('item_code', 'ACCS-KW')->first();
        $bom5->material()->attach($material1);


        //---------------------------------------------------------------
        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-26"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-26')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-26')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);
        
        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-30"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-30')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-26')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-33"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-33')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-33')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-36"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-36')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-36')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-38"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-38')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-38')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-39"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-39')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-39')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-40"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-40')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-40')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-41"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-41')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-41')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-42"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-42')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-42')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-43"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-43')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-43')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-44"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-44')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-44')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);
        
        $bom6 = Bom::create(["bom_code" => "BKG-HRCS-45"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-45')->first();
        $material3 = Material::where('item_code', 'MNRCK-SIZE-45')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        //-----------------------------------------------------------------------
        
        $bom6 = Bom::create(["bom_code" => "BKG-NMAX-HRCS-38"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-38')->first();
        $material3 = Material::where('item_code', 'YMH-NMAX')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-NMAX"]);
        $material = Material::where('item_code', 'YMH-NMAX')->first();
        $bom6->material()->sync($material);
        $bom6 = Bom::create(["bom_code" => "BKG-PCX-HRCS-38"]);
        $material2 = Material::where('item_code', 'HRCS-SIZE-38')->first();
        $material3 = Material::where('item_code', 'HND-PCX-160')->first();
        $bom6->material()->sync([$material2->item_code, $material3->item_code]);

        $bom6 = Bom::create(["bom_code" => "BKG-PCX"]);
        $material = Material::where('item_code', 'HND-PCX-160')->first();
        $bom6->material()->sync($material);
    }
}
