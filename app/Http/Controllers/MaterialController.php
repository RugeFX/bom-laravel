<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Material::with(["helmet", "medicine", "general", "hardcase"])->get()->map(function ($data) {
                $item = $data->helmet ?? $data->medicine ?? $data->general ?? $data->hardcase;
                return [
                    "id" => $item->id,
                    "item_code" => $item->item_code,
                    "name" => $item->name,
                    "model" => $item->getTable(),
                    "created_at" => $item->created_at,
                    "updated_at" => $item->updated_at,
                ];
            });

        return response()->json([
            "message" => "Success",
            "data" => $items,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Material::with(["helmet", "medicine", "general", "hardcase"])
        ->find($id);

        if (!$material) {
            return response()->json([
                "message" => "Material not found",
                "data" => null,
            ], 404);
        }

        $item = $material->helmet ?? $material->medicine ?? $material->general ?? $material->hardcase;

        $response = [
            "id" => $item->id,
            "item_code" => $item->item_code,
            "name" => $item->name,
            "model" => $item->getTable(),
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at,
        ];

        return response()->json([
            "message" => "Success",
            "data" => $response,
        ]);
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
    public function destroy(Material $material)
    {
        $material->delete();

        return response()->json(["message" => "Success"]);
    }
}
