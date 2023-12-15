<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class MedicineController extends Controller
{
    /**
     * The controller main model's array of possible relations.
     */
    public $possible_relations = ["master", "material"];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = new Medicine;

        $relations = $request->input("relations");
        if ($relations) {
            $data = handle_relations($relations, $this->possible_relations, $data);
        }
        return response()->json(["message" => "Success", "data" => $data->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "item_code" => "required|string|unique:materials,item_code",
                "name" => "required|string",
                "quantity" => "required|integer",
            ]);
            $validated["master_code"] = "MSMDCN";

            $data = Medicine::query()->create($validated);

            return response()->json(["message" => "Success", "data" => $data]);
        } catch (\Exception $ex) {
            if ($ex instanceof ValidationException) {
                return response()->json(["message" => "Failed", "error" => $ex->errors()], Response::HTTP_BAD_REQUEST);
            }
            return response()->json(["message" => "Failed", "error" => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $data = new Medicine;

        $relations = $request->input("relations");
        if ($relations) {
            $data = handle_relations($relations, $this->possible_relations, $data);
        }

        $data = $data->find($id);
        if (!$data) {
            return response()->json(["message" => "Failed", "error" => "Record not found!"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["message" => "Success", "data" => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Medicine::query()->with("material")->find($id);

        if (!$data) {
            return response()->json(["message" => "Failed", "error" => "Record not found!"], Response::HTTP_NOT_FOUND);
        }

        try {
            $validated = $request->validate([
                "item_code" => "string|unique:materials,item_code," . $request->input("item_code"),
                "name" => "string",
                "quantity" => "integer",
            ]);

            $data->fill($validated);
            if (array_key_exists("item_code", $validated)) {
                $data->material->item_code = $validated["item_code"];
            }
            $data->push();

            return response()->json(["message" => "Success", "data" => $data]);
        } catch (\Exception $ex) {
            if ($ex instanceof ValidationException) {
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
        $data = Medicine::query()->find($id);

        if (!$data) {
            return response()->json(["message" => "Failed", "error" => "Record not found!"], Response::HTTP_NOT_FOUND);
        }

        $data->delete();

        return response()->json(["message" => "Success"]);
    }
}
