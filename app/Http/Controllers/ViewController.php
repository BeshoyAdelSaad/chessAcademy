<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ViewController extends Controller
{

////////////////////////////


public function register(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'min:3', 'max:100'],
        'email' => ['required', 'email', Rule::unique('users', 'email')],
        'password' => ['required', 'min:8', 'max:255']
    ]);

    $request['password'] = bcrypt($request['password']);

    User::create($request->post());

    // return response()->json([
    //     'Status' => 'True',
    //     'Message' => 'Welcome ' . $request->name . ' You are registered'
    // ]);

    return view('welcome', ['message', 'You are register']);

}

public function authenticate(Request $request)
{
    $chekUser = request(['email', 'password']);

    if(! $token = auth()->guard('user-api')->attempt($chekUser)){
        return response()->json([
            'Message' => 'The email or password is invalid',
    ]);
    }
    // return view('welcome',
    //     [
    //         'Message' => 'Successfully you are login',
    //         'token' => $token
    //     ]);
    return view('welcome',compact('token'));
}

public function login()
{
    return view('login');
}

public function logout()
{

    if(! request('token')){
        return response()->json(['Message' => 'Something went wrong']);
    }
    auth()->guard('user-api')->logout();
    return view('welcome', ['Message' => 'Successfully you are logout']);
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



//////////////////////


    public function rules(Request $request)
    {
        // $type means what is the type of the game

        return response()->json([

            'Welcome ' => auth()->guard('user-api')->user()->name,
            // 'Your game type is ' => $type,
            'Your request is' =>
                [
                    'Name' => auth()->guard('user-api')->user()->name,
                    'user_id' => auth()->guard('user-api')->user()->id,
                    'color' => $request->color,
                    'Type of the game' => $request->play_with,
                    'Time' => $request->time,
                    'Level' => $request->level,
                    'Game Moves' => $request->moves,
                    'Your message' => $request->message
                ]
            ]);

    }

    public function playWithFriend(Request $request)
    {
        $gameid = Game::create([
            'from' => auth()->guard('user-api')->user()->name,
            'user_id' => auth()->guard('user-api')->user()->id,
            'color' => $request->color,
            'play_with' => $request->play_with,
            'time' => $request->time,
        ]);

        return view('gameRoom',
            [
                'url' => route('gameroom'),
                'id' => $gameid->id,
                'token' => $request->token

            ]
        );

    }

    public function gameRoom(Request $request)
    {
        if(Game::where( 'id', $request->id)->whereNull('to')->exists())
        {
            $gameid = Game::where( 'id', $request->id)->get();
            foreach ($gameid as $key) { $key; }

            if($key->from !== auth()->user()->name)
            {
                $update = Game::where('id',  $request->id);
                $update->fill(['to' => auth()->user()->name])->save();
                return view('gameRoom');
            }

            else
            {
                return response()->json(['msg' => 'Something went wrong']);
            }
        }

            else
            {
                return response()->json(['msg' => 'Something went wrong']);
            }
    }
}
