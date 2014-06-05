<?php

namespace Transwest\Tickets;

use \Auth;
use \UserRole;
use \Ticket;
use \Utils;

class PendingTickets extends Tickets {

	public $query = null;
	public $paginate = 50;
	public $results = null;

	function __construct() {
		parent::__construct();

		$this->query->where('approved',false);
		$this->query->where('closed',false);
		$this->query->where('resolved',false);
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
						'name' => 'Approve',
						'url' => '/tickets/'.$ticket->id.'/approve',
						'method' => 'PUT'
					),
					array(
						'name' => 'Close',
						'url' => '/tickets/'.$ticket->id,
						'method' => 'DELETE'
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
						'name' => 'Approve',
						'url' => '/tickets/'.$ticket->id.'/approve',
						'method' => 'PUT'
					),
					array(
						'name' => 'Reject',
						'url' => '/tickets/'.$ticket->id.'/reject',
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
						'name' => 'Close',
						'url' => '/tickets/'.$ticket->id,
						'method' => 'DELETE'
					)
				);
			}
			$this->results[$i] = $ticket->toArray();
		}
	}

}