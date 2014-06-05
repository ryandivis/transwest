<?php

class Vehicle extends Eloquent {

	protected $table = 'vehicles';

	protected $fillable = array(
		'business_id',
		'fleet_id',
		'vin',
		'year',
		'make',
		'model'
	);

	public static $rules = array(
		'business_id' => 'required|numeric',
	    'vin'=>'required|alpha_num',
	);

	public function driver() {
		return $this->hasOne('user','vehicle_id');
	}

	public function business() {
		return $this->belongsTo('business','business_id');
	}

	public function mileage() {
		return $this->hasMany('mileage','vehicle_id');
	}

}