<?php

namespace App\Http\Controllers;

use App\Models\DevicesModel;
use App\Models\DeviceTypesModel;
use Illuminate\Http\Request;

class DevicesController extends Controller {
	public function __construct() {
		$this->devices     = new DevicesModel;
		$this->deviceTypes = new DeviceTypesModel;
	}

	public function index() {
		$devices = $this->devices->with('deviceTypes')->paginate(5);
		$types   = $this->deviceTypes->get();
		return view('pages.devices.index', ['devices' => $devices, 'types' => $types]);
	}

	public function save(Request $request) {
		$devices                  = $this->devices;
		$devices->name            = $request->name;
		$devices->description     = $request->description;
		$devices->device_types_id = $request->types_id;
		$devices->weight          = $request->weight;
		$devices->save();

		if ($devices) {
			return response()->json(array(
				'status'  => 1,
				'message' => 'Success Save Data',
			));
		}

		return response()->json(array(
			'status'  => 0,
			'message' => 'Failed Save Data',
		));
	}

	public function update(Request $request) {
		$devices                  = $this->devices->find($request->id);
		$devices->name            = $request->name;
		$devices->description     = $request->description;
		$devices->device_types_id = $request->types_id;
		$devices->weight          = $request->weight;
		$devices->save();

		if ($devices) {
			return response()->json(array(
				'status'  => 1,
				'message' => 'Success Update Data',
			));
		}

		return response()->json(array(
			'status'  => 0,
			'message' => 'Failed Update Data',
		));
	}

	public function delete(Request $request) {
		$devices = $this->devices->find($request->id);
		$devices->delete();
		if ($devices) {
			return response()->json(array(
				'status'  => 1,
				'message' => 'Success Delete Data',
			));
		}

		return response()->json(array(
			'status'  => 0,
			'message' => 'Failed Delete Data',
		));
	}

}
