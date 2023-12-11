<?php

namespace App\Http\Controllers;

use App\Models\Hardcase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class HardcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Hardcase::all();
        return response()->json(["message" => "Success", "data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                "item_code" => "required|string|unique:material_master,item_code",
                "name" => "required|string",
                "quantity" => "required|integer",
                "color_id" => "required|integer|exists:colors,id",
                "size_id" => "required|integer|exists:sizes,id",
            ]);
            $validated["master_id"] = 4;

            $data = Hardcase::query()->create($validated);

            return response()->json(["message" => "Success", "data" => $data]);
        } catch (\Exception $ex) {
            if($ex instanceof ValidationException) {
                return response()->json(["message" => "Failed", "error" => $ex->errors()], Response::HTTP_BAD_REQUEST);
            }
            return response()->json(["message" => "Failed", "error" => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Hardcase::query()->with(["size", "color"])->find($id);

        if(!$data) {
            return response()->json(["message" => "Failed", "error" => "Record not found!"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["message" => "Success", "data" => $data], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Hardcase::query()->find($id);

        if(!$data) {
            return response()->json(["message" => "Failed", "error" => "Record not found!"], Response::HTTP_NOT_FOUND);
        }
        
        try{
            $validated = $request->validate([
                "item_code" => "string|unique:material_master,item_code," . $request->input("item_code"),
                "name" => "string",
                "quantity" => "integer",
                "color_id" => "integer|exists:colors,id",
                "size_id" => "integer|exists:sizes,id",
            ]);
            
            $data->update($validated);

            return response()->json(["message" => "Success", "data" => $data], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $ex) {
            if($ex instanceof ValidationException) {
                return response()->json(["message" => "Failed", "error" => $ex->errors()], Response::HTTP_BAD_REQUEST);
            }
            return response()->json(["message" => "Failed", "error" => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Hardcase::query()->find($id);

        if(!$data) {
            return response()->json(["message" => "Failed", "error" => "Record not found!"], Response::HTTP_NOT_FOUND);
        }

        $data->delete();

        return response()->json(["message" => "Success"], 200);
    }
}
