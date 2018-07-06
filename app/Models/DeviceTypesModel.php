<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceTypesModel extends Model
{
    protected $table = 'device_types';

    protected $fillable = [
        'name', 'description'
    ];

    public function devices()
    {
        return $this->hasMany(DevicesModel::class, 'device_type_id', 'id');
    }
}
