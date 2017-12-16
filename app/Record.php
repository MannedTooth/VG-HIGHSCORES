<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'name', 'unit', 'time', 'decreasing', 'game_id', 'parent_record_id',
    ];

}
