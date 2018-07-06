<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLocationModel extends Model
{
    protected $table = 'game_locations';

    protected $fillable = [
        'name', 'description'
    ];
    
}
