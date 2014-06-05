<?php

namespace Transwest\Tickets;

use \Auth;
use \UserRole;
use \Ticket;
use \Utils;

class ClosedTickets extends Tickets {

	public $query = null;
	public $paginate = 50;
	public $results = null;

	function __construct() {
		parent::__construct();

		$this->query->where(function($query){
			$query->where('closed',true);
			$query->orWherE('resolved',true);
			return $query;
		});
	}

	function addActions() {
		foreach($this->results as $i => $ticket) {
			if(Utils::isSuperuser()) {
				$ticket->actions = array(
					array(
						'name' => 'View',
						'url' => '/tickets/'.$ticket->id,
						'method' => 'GET'
					),
					array(
						'name' => 'Reopen',
						'url' => '/tickets/'.$ticket->id.'/reopen',
						'method' => 'PUT'
					)
				);
			} elseif(Utils::getUserType() == 'Supervisor') {
				$ticket->actions = array(
					array(
						'name' => 'View',
						'url' => '/tickets/'.$ticket->id,
						'method' => 'GET'
					),
					array(
						'name' => 'Reopen',
						'url' => '/tickets/'.$ticket->id.'/reopen',
						'method' => 'PUT'
					)
				);
			} elseif(Auth::user()->id == $ticket->user_id) {
				$ticket->actions = array(
					array(
						'name' => 'View',
						'url' => '/tickets/'.$ticket->id,
						'method' => 'GET'
					),
					array(
						'name' => 'Reopen',
						'url' => '/tickets/'.$ticket->id.'/reopen',
						'method' => 'PUT'
					)
				);
			}
			$this->results[$i] = $ticket->toArray();
		}
	}

}