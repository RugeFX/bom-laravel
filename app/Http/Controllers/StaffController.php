<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["user","role.privilege.menuitem.menugroup"];

    public function index(Request $request)
    {
        $data = new Staff();

        $relations = $request->input("relations");
        if ($relations) {
            $data = handle_relations($relations, $this->possible_relations, $data);
        }

        return response()->json([
            "message" => "Success",
            "data" => $data->get()
        ]);
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
                "code"=>"required|string|unique:staffs,code",
                "name"=>"required|string",
                "role_code"=>"required|string|exists:roles,code",
                "urlImage"=>['file', 'image', 'mimes:jpeg,png,jpg,gif'],
                "information"=>"string",
            ]);
            $data = Staff::query()->create($validated);

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $data = new Staff();

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
    public function update(Request $request, Staff $staff)
    {
        try {
            $validated = $request->validate([
                "code"=> ["string", \Illuminate\Validation\Rule::unique('staffs', 'code')->ignore($staff->code, "code")],
                "name"=>"string",
                "role_code"=>"string|exists:roles,code",
                "urlImage"=>['file', 'image', 'mimes:jpeg,png,jpg,gif'],
                "information"=>"string",
            ]);

            $staff->update($validated);

            return response()->json(["message" => "Success", "data" => $staff]);
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
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return response()->json(["message" => "Success"]);
    }
}
