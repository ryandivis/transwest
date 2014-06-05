<?php

namespace Transwest\Tickets;

use \Auth;
use \UserRole;
use \Ticket;
use \Utils;

class Tickets {

	public $query;

	function __construct() {
		$this->query = Ticket::with('business','user')->orderBy('updated_at','desc');
	}

	function permissions() {

		if(!Utils::isSuperuser()) {
			$this->query->where('business_id',Auth::user()->business_id);	
		}
		
		if(Utils::getUserType() == 'Driver') {
			$this->query->where('user_id',Auth::user()->id);
		} 
	}

	function run() {
		//permissions
		$this->permissions();

		$this->query->paginate($this->paginate);
		$this->results = $this->query->get();

		$this->addActions();

		return $this->results;
	}

	function addActions() {
		
	}
}