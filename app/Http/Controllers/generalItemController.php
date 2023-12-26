<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\GeneralItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class generalItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["bom.material.general","bom.material.motor","reservation","plan","motorItems"];
    public function index(Request $request)
    {
        $data = new GeneralItem();

        $relations = $request->input("relations");
        if ($relations) {
            $data = handle_relations($relations, $this->possible_relations, $data);
        }

        return response()->json(["message" => "Success", "data" => $data->get()]);
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
        try {
            $validated = $request->validate([
                "bom_code" => "required|string|exists:boms,bom_code",
                "name" => "required|string",
                "code" => "required|string",
                "plan_code"=>"required|string|exists:plans,plan_code",
                'status' => [
                    'required',
                    'string',
                    Rule::in(['Ready For Rent','Scrab','In Rental']),
                ],
                'information'=>"string",
            ]);
            
            $bom = Bom::with('material.general')->firstWhere('bom_code', $validated['bom_code']);
            $material = $bom->material;
            $motorStock = $material->map(function ($material) {
                return optional($material->general)->quantity; // Use optional() to handle null values
            })->filter()->toArray();
            $moterCount = GeneralItem::count();
            foreach ($motorStock as $hc) {
                if ($hc <= $moterCount) {
                    return response()->json(["message" => "Failed", "data" => "Hardcase stock only " . $hc]);
                }
            }
            $data = GeneralItem::query()->create($validated);   

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
    public function show(Request $request,string $id)
    {
        $data = new GeneralItem();

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneralItem $generalItem)
    {
        try {
            $validated = $request->validate([
                "bom_code" => "string|exists:boms,bom_code",
                "name" => "string",
                "code" => "string",
                "plan_code"=>"string|exists:plans,plan_code",
                'status' => [
                    'string',
                    Rule::in(['Ready For Rent','Scrab','In Rental']),
                ],
                'information'=>"string",
            ]);

            $generalItem->update($validated);

            return response()->json(["message" => "Success", "data" => $generalItem]);
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
    public function destroy(GeneralItem $generalItem)
    {
        $generalItem->delete();

        return response()->json(["message" => "Success"]);
    }
}
