<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'name', 'unit', 'time', 'decreasing', 'game_id', 'parent_record_id',
    ];

    public function attempts()
    {
        return $this->hasMany('App\Attempt');
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }
}
