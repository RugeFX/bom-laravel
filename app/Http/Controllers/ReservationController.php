<?php

namespace App\Http\Controllers;

use App\Models\GeneralItem;
use App\Models\HelmetItem;
use App\Models\MotorItem;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["helmetItems", "fakItems","motorItems","hardcaseItems","return","pickup","motoritems.general"];

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
                'hardcase' => 'array',
                "fak.*.fak_code" => "required|string|exists:fakItems,code",
                "helmet.*.helmet_code"=>"required|string|exists:helmetItems,code",
                "motor.*.motor_code"=>"required|string|exists:motorItems,code",
                "hardcase.*.hardcase_code"=>"string|exists:hardcaseItems,code",
                'status'=>[
                    'required',
                    'string',
                    Rule::in(['Finished Rental','In Rental']),
                ],
                'information'=>"string",
            ]);
            $data = Reservation::query()->create($validated);
            if(array_key_exists("fak",$validated)){
                $fak = convert_array($validated["fak"]);
                foreach ($validated['fak'] as $piece) {
                    if ($piece["fak_code"] ?? false) {
                        $data->fakItems()->sync($fak);
                    }
                }

            }
            if(array_key_exists("helmet",$validated)){
                $helmet = convert_array($validated["helmet"]);
                foreach ($validated['helmet'] as $piece) {
                    if ($piece["helmet_code"] ?? false) {
                        $data->helmetItems()->sync($helmet);
                    }
                }
            }
            if(array_key_exists("motor",$validated)){
                $motor = convert_array($validated["motor"]);
                foreach ($validated['motor'] as $piece) {
                    if ($piece["motor_code"] ?? false) {
                        $data->motorItems()->sync($motor);
                    }
                }
            }
            if(array_key_exists("hardcase",$validated)){
                $hardcase = convert_array($validated["hardcase"]);
                foreach ($validated['hardcase'] as $piece) {
                    if ($piece["hardcase_code"] ?? false) {
                        $data->hardcaseItems()->sync($hardcase);
                    }
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
                "returnPlan_code" => "string|exists:plans,plan_code",
                "reservation_code" => ["string", \Illuminate\Validation\Rule::unique('reservations', 'reservation_code')->ignore($reservation->reservation_code, "reservation_code")],
                'helmet' => 'required|array',
                'fak' => 'required|array',
                'motor' => 'required|array',
                'hardcase' => 'array',
                "fak.*.fak_code" => "required|string|exists:fakItems,code",
                "hardcase.*.hardcase_code" => "string|exists:hardcaseItems,code",
                "helmet.*.helmet_code"=>"required|string|exists:helmetItems,code",
                "motor.*.motor_code"=>"required|string|exists:motorItems,code",
                "fak.*.status" =>[
                    'required',
                    'string',
                    Rule::in(['Complete','Incomplete']),
                ],
                "helmet.*.status"=> [
                    'required',
                    'string',
                    Rule::in(['Lost','Scrab','Ready For Rent']),
                ],
                "motor.*.status"=>[
                    'required',
                    'string',
                    Rule::in(['Ready For Rent', 'Out Of Service']),
                ],
                "hardcase.*.status"=>[
                    'required',
                    'string',
                    Rule::in(['Lost','Scrab','Ready For Rent']),
                ],
                'status'=>[
                    'required',
                    'string',
                    Rule::in(['Finished Rental','In Rental']),
                ],
                'information'=>"string",
            ]);
            if(array_key_exists("fak",$validated)){
                $fak = convert_array($validated["fak"]);
                foreach ($validated['fak'] as $piece) {
                    if ($piece["fak_code"] ?? false) {
                        $reservation->fakItems()->sync($fak);
                    }
                }

            }
            if(array_key_exists("helmet",$validated)){
                $helmet = convert_array($validated["helmet"]);
                foreach ($validated['helmet'] as $piece) {
                    if ($piece["helmet_code"] ?? false) {
                        $reservation->helmetItems()->sync($helmet);
                    }
                }
            }
            if(array_key_exists("motor",$validated)){
                $motor = convert_array($validated["motor"]);
                foreach ($validated['motor'] as $piece) {
                    if ($piece["motor_code"] ?? false) {
                        $reservation->motorItems()->sync($motor);
                    }
                }
            }
            if(array_key_exists("hardcase",$validated)){
                $hardcase = convert_array($validated["hardcase"]);
                foreach ($validated['hardcase'] as $piece) {
                    if ($piece["hardcase_code"] ?? false) {
                        $reservation->hardcaseItems()->sync($hardcase);
                    }
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
