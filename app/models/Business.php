<?php

class Business extends BaseModel {

	protected $table = 'businesses';

	private $rules = array(
		'name' => 'required',
		'phone' => 'required'
	);

	public function users() {
		return $this->hasMany('user','business_id');
	}

	public function vehicles() {
		return $this->hasMany('vehicles','business_id');
	}

}