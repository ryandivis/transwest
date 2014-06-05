<?php

class Business extends BaseModel {

	protected $table = 'businesses';

	private $rules = array(
		'name' => 'required',
		'phone' => 'required'
	);

	public function users() {
		return $this->hasMany('User','business_id');
	}

	public function vehicles() {
		return $this->hasMany('Vehicle','business_id');
	}

}