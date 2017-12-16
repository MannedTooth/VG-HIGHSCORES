<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name', 'nickname',
    ];

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'games_genres', 'game_id');
    }
}
