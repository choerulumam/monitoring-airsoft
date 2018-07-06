<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerHasRolesModel extends Model
{
    protected $table = 'player_has_roles';

    protected $fillable = [
        'pools_id', 'roles_id', 'user_id'
    ];

    public function playerPools()
    {
        return $this->hasOne(PlayerPools::class, 'id', 'pools_id');
    }

    public function playerRoles()
    {
        return $this->hasOne(PlayerRolesModel::class, 'id', 'roles_id');
    }
    
}
