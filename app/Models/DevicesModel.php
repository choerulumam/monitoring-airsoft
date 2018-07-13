<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevicesModel extends Model {
	protected $table = 'devices';

	protected $fillable = [
		'name', 'description', 'device_types_id', 'weight', 'images',
	];

	public function deviceTypes() {
		return $this->hasOne(DeviceTypesModel::class, 'id', 'device_types_id');
	}

}
