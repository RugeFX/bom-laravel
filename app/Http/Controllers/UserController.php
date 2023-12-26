<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["staff.role.privilege.menuitem.menugroup"];

    public function index(Request $request)
    {
        $data = new User();

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
                "username"=>"required|string|unique:users,username",
                "password"=>"required|string",
                "staff_code"=>"required|string|exists:roles,code|unique:users,staff_code",
            ]);
            $data = User::query()->create($validated);

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
        $data = new User();

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
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                "staff_code"=> ["string", \Illuminate\Validation\Rule::unique('users', 'staff_code')->ignore($user->staff_code, "staff_code"), \Illuminate\Validation\Rule::exists('staffs', 'code')],
                "username"=>[\Illuminate\Validation\Rule::unique('users', 'username')->ignore($user->staff_code, "username")],
                "password"=>"string",
            ]);

            $user->update($validated);

            return response()->json(["message" => "Success", "data" => $user]);
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
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["message" => "Success"]);
    }
}
