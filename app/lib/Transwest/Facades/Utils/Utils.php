<?php

namespace Transwest\Facades\Utils;

use \Route;
use \User;
use \Auth;
use \Session;
use \Config;
use \Ticket;

class Utils {

	/*
	 * Get the account type for a given user
	 * 
	 * Get the associated account type for the current user (or provided id) account.
	 * 
	 * @param int|null $id The user account id (optional).
	 * @return string
	 */
	public function getUserType($id=null) {
		if(empty($id)) {
			$id = Auth::user()->id;
		}
		$user = User::with('user_role')->find($id);
		return $user->user_role->role;
	}
	
	/*
	 * Determine whether a user is a superuser
	 * 
	 * Determines if current user (or provided id) is a superuser.
	 * 
	 * @param int|null $id The user account id (optional).
	 * @return bool
	 */
	public function isSuperuser($id=null) {
		$isSuperuser = false;
		if(empty($id)) {
			$id = Auth::user()->id;
		}
		$user = User::with('user_role')->find($id);
		if($user->user_role->role == 'Super Admin') {
			$isSuperuser = true;
		}		
		return $isSuperuser;
	}

	public function isManager($id=null) {
		$isManager = false;
		if(empty($id)) {
			$id = Auth::user()->id;
		}
		$user = User::with('user_role')->find($id);
		if(in_array($user->user_role->role, array('Vehicle Manager','Super Admin','Supervisor'))) {
			$isManager = true;
		}
		return $isManager;
	}

	/*
	 * Determines if the logged in user can edit a given ticket
	 *
	 * @param int $id The id of the ticket
	 * @return bool
	 */
	public function canEditTicket($id) {

		if(Utils::isSuperuser()) return true;

		$ticket = Ticket::find($id);
		$user = User::find(Auth::user()->id);

		if($ticket->user_id == $user->id) return true;

		switch(Utils::getUserType()) {
			case 'Vehicle Manager':
				if($ticket->business_id == $user->business_id) return true;
				break;
			case 'Supervisor':
				$ticketOwner = User::find($ticket->user_id);
				if($ticketOwner->supervisor_id == $user->id) return true;
				break;
		}

		return false;
	}

	/*
	 * Determines if the logged in user can edit a given ticket
	 *
	 * @param int $id The id of the ticket
	 * @return bool
	 */
	public function canManageTicket($id) {

		if(Utils::isSuperuser()) return true;

		$ticket = Ticket::find($id);
		$user = User::find(Auth::user()->id);

		switch(Utils::getUserType()) {
			case 'Vehicle Manager':
				if($ticket->business_id == $user->business_id) return true;
				break;
			case 'Supervisor':
				$ticketOwner = User::find($ticket->user_id);
				if($ticketOwner->supervisor_id == $user->id) return true;
				break;
		}

		return false;
	}
	
}