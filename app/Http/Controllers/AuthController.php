<?php

namespace App\Http\Controllers;

use App\Models\Menugroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        try{
            $validated = $request->validate([
                "username" => "required|string|exists:users,username",
                "password" => "required|string",
            ]);
            $username = $validated["username"];
            $password = $validated["password"];
            
            $user = User::firstWhere("username", $username);
    
            if (!Hash::check($password, $user->password)) {
                return response([
                    "message" => "The email or password entered is incorrect."
                ],Response::HTTP_BAD_REQUEST);
            }
    
            $token = $user->createToken("auth")->plainTextToken;
    
            $menus = Menugroup::whereHas('menuitem', function ($query) use ($user) {
                $query->whereHas('privilege', function ($subQuery) {
                    $subQuery->where('view', 1);
                });
            })->get();
            
            $result = [];
            
            foreach ($menus as $menu) {
                $result[] = [
                        'name' => $menu->name,
                        'id'=>$menu->id,
                        'code'=>$menu->code,
                        'menuitem' => $menu->menuitem->map(function ($item) use ($user){
                            $privilege = $item->privilege->where('role_code',$user->staff->role_code)->first();
                            return [
                                'id'=>$item->id,
                                'code'=>$item->code,
                                'name' => $item->name,
                                'url' => $item->url,
                                'privilege' => $privilege,
                            ];
                        }),
                ];
            }
            // $setting = Setting::get();
            $data = [
                "user" => $user,
                "privilege" => $result,
                // "setting"=>$setting,
                "token" => $token
            ];
            return response()->json(["message" => "Success", "data" => $data],Response::HTTP_OK);

        }catch (\Exception $ex) {
            if ($ex instanceof ValidationException) {
                return response()->json(["message" => "Failed", "error" => $ex->errors()], Response::HTTP_BAD_REQUEST);
            }
            return response()->json(["message" => "Failed", "error" => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function logout(Request $request)
    {
        $user = User::find(auth("sanctum")->user()->id);
        $user->tokens()->delete();
    }

    // get authenticated user profile
    public function profile()
    {
        $user = auth("sanctum")->user();

        $menus = Menugroup::whereHas('menuitem', function ($query) use ($user) {
            $query->whereHas('privilege', function ($subQuery) {
                $subQuery->where('view', 1);
            });
        })->get();
        
        $result = [];
        
        foreach ($menus as $menu) {
            $result[] = [
                    'name' => $menu->name,
                    'id'=>$menu->id,
                    'code'=>$menu->code,
                    'menuitem' => $menu->menuitem->map(function ($item) use ($user){
                        $privilege = $item->privilege->where('role_code',$user->staff->role_code)->first();
                        return [
                            'id'=>$item->id,
                            'code'=>$item->code,
                            'name' => $item->name,
                            'url' => $item->url,
                            'privilege' => $privilege,
                        ];
                    }),
            ];
        }

        // $userWithRelations = User::with('staff.role.privilege.menuitem.menugroup')->find($user->id);
        $data = [
            'user'=>$user,
            'privilege'=>$result
        ];
        return response()->json(["message" => "Success", "data" => $data],Response::HTTP_OK);

    }
}