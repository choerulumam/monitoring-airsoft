<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchSettingsModel extends Model
{
    protected $table = 'match_rules';

    protected $fillable = [
        'description', 'high_point', 'limit_time', 
        'max_hp', 'max_player', 'name'
    ];

}
