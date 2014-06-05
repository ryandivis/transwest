<?php

namespace Transwest\Tickets;

use \Auth;
use \UserRole;
use \Ticket;
use \Utils;

class OpenTickets extends Tickets {

	public $query = null;
	public $paginate = 50;
	public $results = null;

	function __construct() {
		parent::__construct();

		$this->query->where('approved',true)
			->where('resolved',false);
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
						'name' => 'Schedule',
						'url' => '/tickets/'.$ticket->id.'/schedule',
						'method' => 'PUT'
					),
					array(
						'name' => 'Mark Resolved',
						'url' => '/tickets/'.$ticket->id.'/resolve',
						'method' => 'PUT'
					)
				);
			}
			$this->results[$i] = $ticket->toArray();
		}
	}

}