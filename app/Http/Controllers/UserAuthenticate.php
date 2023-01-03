<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserAuthenticate extends Controller
{


    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        $request['password'] = bcrypt($request['password']);

        User::create($request->post());

        return response()->json([
            'Status' => 'True',
            'Message' => 'Welcome ' . $request->name . ' You are registered'
        ]);

    }

    public function login(Request $request)
    {
        $chekUser = request(['email', 'password']);

        if(! $token = auth()->guard('user-api')->attempt($chekUser)){
            return response()->json(['Message' => 'The email or password is invalid']);
        }

        return response()->json([
            'Message' => 'Successfully you are login',
            'Token' => $token,
            'url' => route('gameroom')
        ]);

    }

    public function logout()
    {

        if(! request('token')){
            return response()->json(['Message' => 'Something went wrong']);
        }
        auth()->guard('user-api')->logout();
        return response()->json(['Message' => 'Successfully you are logout']);
    }

    public function aboutMe()
    {
        return response()->json(
            [
                'Your name is: ' => auth()->guard('user-api')->user()->name,
                'Your email is: ' => auth()->guard('user-api')->user()->email
            ]
            );
    }

}
