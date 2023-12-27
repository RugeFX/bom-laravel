<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\HardcaseItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class hardcaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["bom.material.hardcase", "reservation","plan","motorItem"];

    public function index(Request $request)
    {
        $data = new HardcaseItem();

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
                "code" => "required|string|unique:hardcaseItems,code",
                "plan_code"=>"required|string|exists:plans,plan_code",
                "monorack_code"=>"string|unique:hardcaseItems,monorack_code",
                'status' => [
                    'required',
                    'string',
                    Rule::in(['Ready For Rent','Scrab','In Rental']),
                ],
                'information'=>"string",
            ]);
            
            $bom = Bom::with('material.hardcase')->firstWhere('bom_code', $validated['bom_code']);
            $stock = $bom->material;
            $hardcaseStock = $stock->map(function ($material) {
                return optional($material->hardcase)->quantity;

            })->filter()->toArray();
            $hardcaseCount = HardcaseItem::count();
            foreach($hardcaseStock as $h){
                if($h<=$hardcaseCount){
                    return response()->json(["message" => "Failed", "data" => $hardcaseCount]);
                }
            }
            $data = HardcaseItem::query()->create($validated);

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
        $data = new HardcaseItem();

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
    public function update(Request $request, HardcaseItem $hardcaseItem)
    {
        try {
            $validated = $request->validate([
                "bom_code" => "string|exists:boms,bom_code",
                "name" => "string",
                "code" => ["string", \Illuminate\Validation\Rule::unique('hardcaseItems', 'code')->ignore($hardcaseItem->code, "code")],
                "plan_code"=>"string|exists:plans,plan_code",
                "monorack_code"=> ["string", \Illuminate\Validation\Rule::unique('hardcaseItems', 'monorack_code')->ignore($hardcaseItem->monorack_code, "monorack_code")],  
                'status' => [
                    'string',
                    Rule::in(['Ready For Rent','Scrab','In Rental']),
                ],
                'information'=>"string",
            ]);

            $hardcaseItem->update($validated);

            return response()->json(["message" => "Success", "data" => $hardcaseItem]);
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
    public function destroy(HardcaseItem $hardcaseItem)
    {
        $hardcaseItem->delete();

        return response()->json(["message" => "Success"]);
    }
}
