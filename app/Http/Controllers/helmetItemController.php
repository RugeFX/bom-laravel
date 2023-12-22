<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\Helmet;
use App\Models\HelmetItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class helmetItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["bom.material.helmet", "reservation","plan"];
    public function index(Request $request)
    {
        $data = new HelmetItem();

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
                'status'=>"required|string",
                'information'=>"string",
            ]);
            
            $bom = Bom::with('material.helmet')->firstWhere('bom_code', $validated['bom_code']);
            $stock = $bom->material;
            $helmetStock = $stock->map(function ($material) {
                $helmet = $material->helmet;
                return $helmet->quantity;
            });
            $helmetCount = HelmetItem::count();
            foreach($helmetStock as $h){
                if($h<=$helmetCount){
                    return response()->json(["message" => "Failed", "data" => $helmetCount]);
                }
            }
            $data = HelmetItem::query()->create($validated);

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
        $data = new HelmetItem();

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
    public function update(Request $request, HelmetItem $helmetItem)
    {
        try {
            $validated = $request->validate([
                "bom_code" => "string|exists:boms,bom_code",
                "name" => "string",
                "code" => "string",
                "plan_code"=>"string|exists:plans,plan_code",
                'status'=>"string",
                'information'=>"string",
            ]);

            $helmetItem->update($validated);

            return response()->json(["message" => "Success", "data" => $helmetItem]);
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
    public function destroy(HelmetItem $helmetItem)
    {
        $helmetItem->delete();

        return response()->json(["message" => "Success"]);
    }
}
