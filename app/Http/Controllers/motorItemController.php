<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\MotorItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class motorItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["bom.material.general","bom.material.motor", "reservation","plan","hardcase","general"];
    public function index(Request $request)
    {
        $data = new MotorItem();

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
                "hardcase_code"=>"string|exists:hardcaseItems,code|unique:motorItems,hardcase_code",
                "general"=>"array",
                "general.*.general_code"=>"string|exists:generalItems,code|unique:motorItem_generalItem,general_code",
                'status' => [
                    'required',
                    'string',
                    Rule::in(['Ready For Rent', 'Out Of Service', 'In Rental']),
                ],
                'information'=>"string",
            ]);
            $bom = Bom::with('material.motor')->firstWhere('bom_code', $validated['bom_code']);
            $material = $bom->material;
            $motorStock = $material->map(function ($material) {
                return optional($material->motor)->quantity; // Use optional() to handle null values
            })->filter()->toArray();
            $moterCount = MotorItem::count();
            foreach ($motorStock as $hc) {
                if ($hc <= $moterCount) {
                    return response()->json(["message" => "Failed", "data" => "Motor stock only " . $hc]);
                }
            }
            $data = MotorItem::query()->create($validated);
            $general = convert_array($validated['general']);
            $data->general()->sync($general);
            $data->update($validated);


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
        $data = new MotorItem();

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
    public function update(Request $request, MotorItem $motorItem)
    {
        try {
            $validated = $request->validate([
                "bom_code" => "string|exists:boms,bom_code",
                "name" => "string",
                "code" => "string",
                "plan_code"=>"string|exists:plans,plan_code",
                "hardcase_code"=>"string|exists:hardcaseItems,code",
                "general"=>"array",
                "general.*.general_code"=>"string|exists:generalItems,code",
                'status' => [
                    'string',
                    Rule::in(['Ready For Rent', 'Out Of Service', 'In Rental']),
                ],
                'information'=>"string",
            ]);
            $general = convert_array($validated['general']);
            $motorItem->general()->sync($general);
            $motorItem->update($validated);

            return response()->json(["message" => "Success", "data" => $motorItem]);
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
    public function destroy(MotorItem $motorItem)
    {
        $motorItem->delete();

        return response()->json(["message" => "Success"]);
    }
}
