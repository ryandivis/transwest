<?php

class Comment extends Eloquent {

	protected $table = 'comments';

	protected $fillable = array(
		'ticket_id',
		'user_id',
		'comment'
	);

	public static $rules = array(
		'ticket_id' => 'required|numeric',
		'user_id' => 'required|numeric',
	    'comment'=>'required|alpha_num',
	);

	public function ticket() {
		return $this->belongsTo('ticket','ticket_id');
	}

	public function user() {
		return $this->belongsTo('user','user_id');
	}

}