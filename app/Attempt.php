<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = [
        'score', 'time', 'url', 'user_id', 'record_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function record()
    {
        return $this->belongsTo('App\Record');
    }
}
