<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class RulesController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

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
        Game::create([
            'from' => auth()->guard('user-api')->user()->name,
            'user_id' => auth()->guard('user-api')->user()->id,
            'color' => $request->color,
            'play_with' => $request->play_with,
            'time' => $request->time,
        ]);

        return response()->json(
            [
                'url' =>
                'http://localhost:8000/api/users/game/room/' . auth()->guard('user-api')->user()->id
            ]
        );

    }

    public function gameRoom($id)
    {
        // search this id in database game & vs is null
        $gameId = Game::find($id);
        // $gameid !== game-> user
        // update vs = auth->user->name
        return response()->json($gameId);

    }

}
