<?php

use \Transwest\Tickets\OpenTickets;
use \Transwest\Tickets\PendingTickets;
use \Transwest\Tickets\ClosedTickets;

class TicketsController extends BaseController {

	public function getTickets()
	{

		$user = Auth::user();
		$superAdmin = $supervisor = false;

		$superAdminRole = UserRole::where('role','Super Admin')->first();
		$supervisorRole = UserRole::where('role','Supervisor')->first();

		if($user->user_role == $superAdminRole->id){
			$superAdmin = true;
		} elseif($user->user_role == $supervisorRole->id) {
			$supervisor = true;
		}

		$tickets = new PendingTickets();
		$pendingTickets = $tickets->run();

		$tickets = new OpenTickets();
		$openTickets = $tickets->run();

		$tickets = new ClosedTickets();
		$closedTickets = $tickets->run();

		return Response::json(array(
			'status' => 'ok',
			'tickets' => array(
				'open' => $openTickets->toArray(),
				'pending' => $pendingTickets->toArray(),
				'closed' => $closedTickets->toArray()
			)
		));
	}

	public function getTicket($id) {
		$user = User::with('user_role')->find(Auth::user()->id);
		$ticket = Ticket::with('user','user.vehicle','comments','comments.user','business','consenter','resolver','closer')->find($id);

		if($ticket->user_id != $user->id) {
			switch($user->user_role->role) {
				case 'Super Admin':
					break;
				case 'Vehicle Manager': 
					if($ticket->business_id != $user->business_id) {
						return $this->error('You do not have permission to access ticket #'.$ticket->id);
					}
					break;
				case 'Supervisor':
					if($ticket->user->supervisor_id != $user->id) {
						return $this->error('You do not have permission to access ticket #'.$ticket->id);
					}
					break;
				default:
					if($ticket->user_id != $user->id) {
						return $this->error('You do not have permission to access ticket #'.$ticket->id);
					}
			}	
		}

		return Response::json(array(
			'status' => 'ok',
			'ticket' => $ticket->toArray()
		));
	}

	public function addTicketComment($id) {
		if(Utils::canEditTicket($id)) {
			$ticket = Ticket::find($id);
			if(Input::has('comment')){
				$postComment = Input::get('comment');
				$postComment['user_id'] = Auth::user()->id;

				$comment = new Comment($postComment);

				if($ticket->comments()->save($comment)){
					return Response::json(array(
						'status' => 'ok',
						'message' => 'Comment successfully added',
						'comment' => Comment::with('user')->find($comment->id)->toArray()
					));
				} else {
					return $this->error('There was an error saving the comment.');
				}
			} else {
				return $this->error('You must submit a comment.');
			}
		} else {
			return $this->error('You do not have permission to add a comment.');
		}
	}

	//TODO:: need to make this different
	public function editTicket($id) {
		//check to make sure user can edit ticket
		//check to make sure issue is not blank
		if(Utils::canEditTicket($id)) {
			$ticket = Ticket::find($id);
			print_r(Input::get('ticket')); die();
			if(Input::has('issue')) {
				$issue = Input::get('issue');
				if(strlen(trim($issue)) > 0) {
					$ticket->issue = $issue;
					$ticket->save();

					//save comment if there is any

					return Response::json(array(
						'status' => 'ok',
						'message' => 'Ticket updated successfully'
					));
				} else {
					return $this->error('The ticket must have an issue.');
				}
					
			} else {
				return $this->error('The ticket must have an issue.');
			}
		} else {
			return $this->error('You do not have permission to edit this ticket.');
		}
		
	}

	public function approveTicket($id) {
		if(Utils::canManageTicket($id)) {
			$ticket = Ticket::find($id);
			$ticket->approved = true;
			$ticket->approved_by = Auth::user()->id;	
			$ticket->approved_timestamp = 'NOW()';
			if($ticket->save()) {
				return Response::json(array(
					'status' => 'ok',
					'message' => 'The ticket has been approved'
				));
			} else {
				return $this->error('There was an error approving the ticket.');
			}
		} else {
			return $this->error('You do not have permission to approve this ticket.');
		}
	}

	public function deleteTicket($id) {
		if(Utils::canEditTicket($id)) {
			$ticket = Ticket::find($id);
			$ticket->closed = true;
			$ticket->closed_by = Auth::user()->id;	
			$ticket->closed_timestamp = 'NOW()';
			if($ticket->save()) {
				return Response::json(array(
					'status' => 'ok',
					'message' => 'The ticket has been closed'
				));
			} else {
				return $this->error('There was an error closing the ticket');
			}
		} else {
			return $this->error('You do not have permission to close this ticket.');
		}
	}

	public function resolveTicket($id) {
		if(Utils::canManageTicket($id)) {
			$ticket = Ticket::find($id);
			$ticket->resolved = true;
			$ticket->resolved_by = Auth::user()->id;	
			$ticket->resolved_timestamp = 'NOW()';
			if($ticket->save()) {
				return Response::json(array(
					'status' => 'ok',
					'message' => 'The ticket has been marked as resolved'
				));
			} else {
				return $this->error('There was an error resolving the ticket');
			}
		} else {
			return $this->error('You do not have permission to resolve this ticket.');
		}	
	}

	public function reopenTicket($id) {
		if(Utils::canManageTicket($id)) {
			$ticket = Ticket::find($id);
			if($ticket->closed === true || $ticket->resolved === true) {
				$ticket->closed = false;
				$ticket->resolved = false;
				if($ticket->save()) {
					return Response::json(array(
						'status' => 'ok',
						'message' => 'Ticket successfully reopened'
					));
				} else {
					return $this->error('There was a problem reopening the ticket.');
				}
			} else {
				return $this->error('The ticket is not currently closed');
			}
		} else {
			return $this->error('You do not have permission to reopen this ticket.');
		}
	}


	public function createTicket() {
		if(!Input::get('issue')) {
			return Response::json(array(
				'status' => 'error',
				'message' => 'You must submit a valid issue.'
			));
		}
		$issue = Input::get('issue');
		$user = Auth::user();
		$user = User::with('user_role')->find($user->id);

		//we instantiate this here so that we can manipulate it as nescessary
		$ticket = new Ticket;

		if(Input::get('user_id') && Input::get('user_id') != $user->id) {
			$postUser = User::find(Input::get('user_id'));
			switch($user->user_role->role) {
				case 'Super Admin':
					$user = $postUser;
					break;
				case 'Vehicle Supervisor':
					if($user->business_id != $postUser->business_id) {
						return Response::json(array(
							'status' => 'error',
							'message' => 'You do not have permission to submit tickets as that user.'
						));	
					} else {
						$ticket->approved = true;
						$ticket->approved_by = $user->id;
						$ticket->approved_timestamp = 'NOW()';
						$user = $postUser;
					}
					break;
				case 'Supervisor':
					if($user->id != $postUser->supervisor_id) {
						return Response::json(array(
							'status' => 'error',
							'message' => 'You do not have permission to submit tickets as that user.'
						));	
					} else {
						$ticket->approved = true;
						$ticket->approved_by = $user->id;
						$ticket->approved_timestamp = 'NOW()';
						$user = $postUser;
					}
					break;
				default:
					if($user->id != $postUser->id) {
						return Response::json(array(
							'status' => 'error',
							'message' => 'You do not have permission to submit tickets as that user.'
						));
					}
			}
		}

		$ticket->user_id = $user->id;
		$ticket->business_id = $user->business_id;
		$ticket->issue = $issue;

		if($ticket->save()) {
			return Response::json(array(
				'status' => 'ok',
				'message' => 'Ticket successfully added.'
			));
		} else {
			return Response::json(array(
				'status' => 'error',
				'message' => 'There was an error saving the ticket.'
			));	
		}
	}

}