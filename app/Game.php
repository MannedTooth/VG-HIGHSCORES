<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name', 'nickname', 'description', 'release_year', 'cover_image_id',
    ];

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'games_genres', 'game_id');
    }

    public function records()
    {
        return $this->hasMany('App\Record');
    }

    public function cover_image()
    {
        return $this->belongsTo('App\Image', 'cover_image_id', 'id');
    }
}
