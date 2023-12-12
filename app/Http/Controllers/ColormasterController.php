<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ColormasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["general", "hardcase", "helmet"];
    public function index(Request $request)
    {
        $relations = $request->input("relations");
        // $fields = $request->input("fields");

        $color = new Color();

        if ($relations) {
            $color = handle_relations($relations, $this->possible_relations, $color);
        }
        return response()->json([
            "data" => $color->get()
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();

        try {
            $newValue = Color::create($validated);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            "message" => "Data Berhasil dibuat",
            "data" => $newValue,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $relations = $request->input("relations");

        $color = new Color();

        if ($relations) {
            $color = handle_relations($relations, $this->possible_relations,  $color);
        }


        return $color->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $validator = Validator::make($request->all(), [
            'name' => "string"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();

        try {
            $color->update($validated);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            "message" => "Data Berhasil diupdate",
            "data" => $color,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return response()->json([
            "message" => "Data Berhasil didelete",
        ], Response::HTTP_OK);
    }
}
