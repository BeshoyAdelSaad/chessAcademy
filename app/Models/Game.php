<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'color',
        'game_type',
        'time',
        'level',
        'from',
        'to',
        'is_win',
        'moves',
        'message'
    ];

    public function userGames()
    {
        return $this->belongsTo(User::class);
    }
}
