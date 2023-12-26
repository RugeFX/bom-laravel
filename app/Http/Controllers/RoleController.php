<?php

namespace App\Http\Controllers;

use App\Models\Menuitem;
use App\Models\Privilege;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $possible_relations = ["staff","privilege.menuitem.menugroup"];
    public function index(Request $request)
    {
        $data = new Role();

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
                "code" => "required|string|unique:roles,code",
                "name" => "required|string|unique:roles,name",
                "menu"=>'array'
            ]);
            $data = Role::query()->create($validated);
            if ($data) {
                // get all menu for insert privilege later
                $menuItems = Menuitem::get()->toArray();
                foreach ($menuItems as $keyX => $menuItem) {
                    // set param and default value to insert privilege
                    $privilege['role_code'] = $data->code;
                    $privilege['menuitem_code'] = $menuItem['code'];
                    $privilege['view'] = 0;
                    $privilege['add'] = 0;
                    $privilege['edit'] = 0;
                    $privilege['delete'] = 0;
                    $privilege['export'] = 0;
                    $privilege['import'] = 0;
                    if (array_key_exists('menu', $validated)) {
                        foreach ($validated['menu'] as $keyY => $menu) {
                            if ($menuItem['code'] == $keyY) {
                                if (array_key_exists('view', $menu)) {
                                    $privilege['view'] = 1;
                                }
                                if (array_key_exists('add', $menu)) {
                                    $privilege['add'] = 1;
                                }
                                if (array_key_exists('edit', $menu)) {
                                    $privilege['edit'] = 1;
                                }
                                if (array_key_exists('delete', $menu)) {
                                    $privilege['delete'] = 1;
                                }
                                if (array_key_exists('export', $menu)) {
                                    $privilege['export'] = 1;
                                }
                                if (array_key_exists('import', $menu)) {
                                    $privilege['import'] = 1;
                                }
                            }
                        }
                    }
                    // create privilege for new role
                    Privilege::create($privilege);
                }
            }

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
        $data = new Role;

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
    public function update(Request $request, Role $role)
    {
        try {
            $validated = $request->validate([
                "name" => "string",
                "menu"=> "array"
            ]);
            if ($role) {
                foreach ($role->privilege as $keyX => $rolePrivilege) {
                    // set param and default value to update privilege
                    $privilege['view'] = 0;
                    $privilege['add'] = 0;
                    $privilege['edit'] = 0;
                    $privilege['delete'] = 0;
                    $privilege['export'] = 0;
                    $privilege['import'] = 0;
                    if (array_key_exists('menu', $validated)) {
                        foreach ($validated['menu'] as $keyY => $menu) {
                            if ($rolePrivilege['menuitem_code'] == $keyY) {
                                if (array_key_exists('view', $menu)) {
                                    $privilege['view'] = 1;
                                }
                                if (array_key_exists('add', $menu)) {
                                    $privilege['add'] = 1;
                                }
                                if (array_key_exists('edit', $menu)) {
                                    $privilege['edit'] = 1;
                                }
                                if (array_key_exists('delete', $menu)) {
                                    $privilege['delete'] = 1;
                                }
                                if (array_key_exists('export', $menu)) {
                                    $privilege['export'] = 1;
                                }
                                if (array_key_exists('import', $menu)) {
                                    $privilege['import'] = 1;
                                }
                            }
                        }
                    }
                    // update privilege
                    Privilege::where('id', $rolePrivilege->id)->update($privilege);
                }
                $role->update($validated);
            }

            return response()->json(["message" => "Success", "data" => $role]);
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
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(["message" => "Success"]);
    }
}
