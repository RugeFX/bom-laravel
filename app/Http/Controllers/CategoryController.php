<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["master"];
    public function index(Request $request)
    {
        $relations = $request->input("relations");

        $category = new Category();

        if ($relations) {
            $category = handle_relations($relations, $this->possible_relations, $category);
        }
        return response()->json([
            "message" => "Success",
            "data" => $category->get()
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
                "message" => "Failed",
                "error" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();

        try {
            $newValue = Category::create($validated);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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

        $category = new Category();

        if ($relations) {
            $category = handle_relations($relations, $this->possible_relations,  $category);
        }

        return response()->json([
            "message" => "Success",
            "data" => $category->findOrFail($id)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => "string"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Failed",
                "error" => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();

        try {
            $category->update($validated);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            "message" => "Success",
            "data" => $category,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            "message" => "Success",
        ], Response::HTTP_OK);
    }
}
