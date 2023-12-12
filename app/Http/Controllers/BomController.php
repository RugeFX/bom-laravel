<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["material"];

    public function index(Request $request)
    {
        $relations = $request->input("relations");

        $bom = new Bom();

        if ($relations) {
            $bom = handle_relations($relations, $this->possible_relations, $bom);
        }
        return response()->json([
            "data"=>$bom->get()
        ],Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bom_code'=>'required|string',
            'item'=>'required|array',
            'item.*.bom_code'=>'required|string',
            'item.*.item_code'=>'required|string',
            'item.*.quantity'=>'required|integer',
        ]);
        if($validator->fails()){
            return response()->json([
                "message"=>$validator->errors(),
            ],Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();
        $bom = convert_array($validated["item"]);
        try{
            $newValue= Bom::create([
                "bom_code"=>$validated['bom_code'],
            ]);
            $newValue->material()->sync($bom);
        }
        catch(\Exception $e){
            return $e;
        }
        return response()->json([
            "message"=>"Data Berhasil dibuat",
            "data"=>$newValue
        ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $relations = $request->input("relations");

        $bom = new Bom();

        if ($relations) {
            $bom = handle_relations($relations, $this->possible_relations,  $bom);
        }


        return $bom->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bom $bom)
    {
        $bom->delete();
        return response()->json([
            "message"=>"Data Berhasil didelete",
        ],Response::HTTP_OK);
    }
}
