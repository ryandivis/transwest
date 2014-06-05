<?php

class Mileage extends Eloquent {

	protected $table = 'mileage';

	protected $fillable = array(
		'vehicle_id',
		'mileage',
		'created_by'
	);

	public static $rules = array(
		'vehicle_id' => 'required|numeric',
	    'mileage'=>'required|numeric',
	    'created_by' => 'required|numeric'
	);

	public function vehicle() {
		return $this->belongsTo('vehicle','vehicle_id');
	}

}