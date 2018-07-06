<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GamePlayLogsModel extends Model
{
    protected $table = 'gameplay_logs';

    protected $fillable = [
        'device_id', 'score', 'status', 'status', 'user_id'
    ];

    public function devices()
    {
        return $this->hasOne(DevicesModel::class, 'device_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
    
}
