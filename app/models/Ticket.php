<?php

class Ticket extends Eloquent {

	protected $table = 'tickets';

	public function user() {
		return $this->belongsTo('user','user_id');
	}

	public function business() {
		return $this->belongsTo('business');
	}

	public function consenter() {
		return $this->belongsTo('user','approved_by');
	}

	public function resolver() {
		return $this->belongsTo('user','resolved_by');
	}

	public function closer() {
		return $this->belongsTo('user','closed_by');
	}

	public function event() {
		return $this->hasOne('ticket','event_id');
	}

	public function comments() {
		return $this->hasMany('comment','ticket_id');
	}

}