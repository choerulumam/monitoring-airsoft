<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerRolesModel extends Model
{
    protected $table = 'player_roles';

    protected $fillable = [
        'name', 'description'
    ];
}
