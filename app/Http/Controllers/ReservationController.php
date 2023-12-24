<?php

namespace App\Http\Controllers;

use App\Models\GeneralItem;
use App\Models\HelmetItem;
use App\Models\MotorItem;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["helmetItems", "fakItems","return","pickup","motoritems.general"];

    public function index(Request $request)
    {
        $data = new Reservation();

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
                "pickupPlan_code" => "required|string|exists:plans,plan_code",
                "reservation_code" => "required|string|unique:reservations,reservation_code",
                'helmet' => 'required|array',
                'fak' => 'required|array',
                'motor' => 'required|array',
                "fak.*.fak_code" => "string|exists:fakItems,code",
                "helmet.*.helmet_code"=>"required|string|exists:helmetitems,code",
                "motor.*.motor_code"=>"required|string|exists:motorItems,code",
                'status'=>"required|string",
                'information'=>"string",
            ]);
            $fak = convert_array($validated["fak"]);
            $helmet = convert_array($validated["helmet"]);
            $motor = convert_array($validated["motor"]);
            $data = Reservation::query()->create($validated);
            foreach ($validated['motor'] as $piece) {
                if ($piece["motor_code"] ?? false) {
                    $data->motorItems()->sync($motor);
                }
            }
            foreach ($validated['helmet'] as $piece) {
                if ($piece["helmet_code"] ?? false) {
                    $data->helmetItems()->sync($helmet);
                }
            }
            foreach ($validated['fak'] as $piece) {
                if ($piece["fak_code"] ?? false) {
                    $data->fakItems()->sync($fak);
                }
            }
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
    public function show(Request $request, $id)
    {
        $relations = $request->input("relations");

        $data = new Reservation();

        if ($relations) {
            $data = handle_relations($relations, $this->possible_relations,  $data);
        }

        return response()->json([
            "message" => "Success",
            "data" => $data->findOrFail($id)
        ], Response::HTTP_OK);
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
    public function update(Request $request, Reservation $reservation)
    {
        try {
            $validated = $request->validate([
                "pickupPlan_code" => "string|exists:plans,plan_code",
                "reservation_code" => "string|unique:reservation,reservation_code",
                'item' => 'array',
                "item.*.fak_code" => "string|exists:fakItems,code",
                "item.*.helmet_code"=>"string|exists:helmetitems,code",
                "item.*.motor_code"=>"string|exists:motorItems,code",
                'status'=>"string",
                'information'=>"string",
            ]);
            $item = convert_array($validated["item"]);
            foreach ($validated['item'] as $piece) {
                
                if ($piece["fak_code"] ?? false) {
                    $reservation->fakItems()->sync($item);
                }
                if ($piece["helmet_code"] ?? false) {
                    $reservation->helmetItems()->sync($item);
                }
                if ($piece["motor_code"] ?? false) {
                    $reservation->motorItems()->sync($item);
                }
            }
            $reservation->update($validated);

            return response()->json(["message" => "Success", "data" => $reservation]);
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
    public function destroy(Reservation $reservation)
    {
        
        $reservation->delete();
        return response()->json(["message" => "Success"]);
    }
}
