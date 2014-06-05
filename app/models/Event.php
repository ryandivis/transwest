<?php

class Event extends Eloquent {

	protected $table = 'events';

	public function user() {
		return $this->belongsTo('User','user_id');
	}

}