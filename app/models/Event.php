<?php

class Event extends Eloquent {

	protected $table = 'events';

	public function user() {
		return $this->belongsTo('user','user_id');
	}

}