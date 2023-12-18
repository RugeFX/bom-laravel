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
    public $possible_relations = ["material.helmet","material.hardcase","material.general","material.medicine"];

    public function index(Request $request)
    {
        $relations = $request->input("relations");

        $bom = new Bom();

        if ($relations) {
            $bom = handle_relations($relations, $this->possible_relations, $bom);
        }
        return response()->json([
            "message" => "Success",
            "data" => $bom->get()
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bom_code' => 'required|string',
            'item' => 'required|array',
            'item.*.item_code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Failed",
                "error" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();
        $bom = convert_array($validated["item"]);
        try {
            $newValue = Bom::create([
                "bom_code" => $validated['bom_code'],
            ]);
            $newValue->material()->sync($bom);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            "message" => "Success",
            "data" => $newValue
        ], Response::HTTP_OK);
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

        return response()->json([
            "message" => "Success",
            "data" => $bom->findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bom $bom)
    {
        $validator = Validator::make($request->all(), [
            'bom_code' => 'string',
            'item' => 'array',
            'item.*.item_code' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Failed",
                "error" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();
        $boms = convert_array($validated["item"]);
        try {
            $bom->update($validated);
            $bom->material()->sync($boms);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            "message" => "succses",
            "data" => $bom
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bom $bom)
    {
        $bom->delete();
        return response()->json([
            "message" => "Success",
        ], Response::HTTP_OK);
    }
}
