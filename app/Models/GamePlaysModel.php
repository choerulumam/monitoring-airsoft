<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamePlaysModel extends Model
{
    protected $table = 'gameplays';

    protected $fillable = [
        'game_finish_date', 'game_locations_id', 'game_start_date', 
        'match_rules_id', 'pools_id'
    ];

    public function playerPools()
    {
        return $this->hasOne(PlayerPoolsModel::class, 'id', 'pools_id');
    }

    public function matchRules()
    {
        return $this->hasOne(MatchSettingsModel::class, 'id', 'match_rules_id');
    }

    public function gameLocations()
    {
        return $this->hasOne(GameLocationModel::class, 'id', 'game_locations_id');
    }

}
