<?php

class AccessCode extends Eloquent {

	protected $table = 'access_codes';

	protected $fillable = array(
    	'business_id',
		'supervisor_id',
		'user_role_id',
		'code'
    );

	public function supervisor() {
		return $this->belongsTo('User','supervisor_id');
	}

	public function business() {
		return $this->belongsTo('Business','bussiness_id');
	}
}