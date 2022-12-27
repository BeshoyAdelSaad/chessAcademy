<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class AdminAuthenticate extends Controller
{
    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:100', 'string'],
            'email' => ['required', 'email', Rule::unique('admins', 'email')],
            'password' => ['required']
        ]);

        $request['password'] = bcrypt($request['password']);


        $addAdmin = AdminModel::create(
            $request->post()
            // [
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => $request->password
            // ]
        );

        return response()->json($addAdmin);

    }

    public function adminLogin()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth()->guard('admin-api')->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized', 'Error' => 401]);
        }
        return $token;

    }

    public function aboutMe()
    {
        return response()->json(auth()->guard('admin-api')->user());
    }

    public function adminLogout()
    {
        auth()->guard('admin-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


}
