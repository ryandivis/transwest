<?php

class Ticket extends Eloquent {

	protected $table = 'tickets';

	public function user() {
		return $this->belongsTo('User','user_id');
	}

	public function business() {
		return $this->belongsTo('Business');
	}

	public function consenter() {
		return $this->belongsTo('User','approved_by');
	}

	public function resolver() {
		return $this->belongsTo('User','resolved_by');
	}

	public function closer() {
		return $this->belongsTo('User','closed_by');
	}

	public function event() {
		return $this->hasOne('Ticket','event_id');
	}

	public function comments() {
		return $this->hasMany('Comment','ticket_id');
	}

}