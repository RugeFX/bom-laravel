<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SizemasterController extends Controller
{
    public $possible_relations = ["master", "hardcase", "helmet"];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $relations = $request->input("relations");

        $size = new Size();

        if ($relations) {
            $size = handle_relations($relations, $this->possible_relations, $size);
        }
        return response()->json([
            "message" => "Success",
            "data" => $size->get()
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string",
            'master_code' => 'required|string|exists:masters,master_code'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Failed",
                "error" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();

        try {
            $newValue = Size::create($validated);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            "message" => "Success",
            "data" => $newValue,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $relations = $request->input("relations");

        $size = new Size();

        if ($relations) {
            $size = handle_relations($relations, $this->possible_relations,  $size);
        }
        
        return response()->json([
            "message" => "Success",
            "data" => $size->findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $validator = Validator::make($request->all(), [
            'name' => "string",
            'master_code' => 'string|exists:masters,master_code'
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Failed",
                "error" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();

        try {
            $size->update($validated);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            "message" => "Success",
            "data" => $size,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return response()->json([
            "message" => "Success",
        ], Response::HTTP_OK);
    }
}
