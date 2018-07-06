<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerPoolsModel extends Model
{
    protected $table = 'player_pools';

    protected $fillable = [
        'name', 'description'
    ];
    
}
