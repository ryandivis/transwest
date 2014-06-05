<?php

class UsersController extends BaseController {

	public function getUsers() {
		$user = Auth::user();
		$user = User::with('user_role')->find($user->id);

		$query = User::with('business');

		switch($user->user_role->role) {
			case 'Super Admin':
				$users = $query->get();
				break;
			case 'Vehicle Manager':
				$users = $query->where('business_id',$user->business_id)
						->orWhere('id',$user->id)->get();
				break;
			case 'Supervisor':
				$users = $query->where('supervisor_id',$user->id)
					->orWhere('id',$user->id)->get();
				break;
			default:
				//can only return their own user
				$users = User::with('business')->where('id',$user->id)->get();
				break;
		}

		return Response::json($users->toArray());
	}

	public function getUser($id = null) {
		if(!$id) {
			$user = Auth::user();
			$id = $user->id;
		}

		$users = User::with('business')->find($id);

		return Response::json($user->toArray());
	}

	/*
	 * Basic CRUD Create functionality
	 *
	 * @return json string
	 */
	public function createUser() {
		$postUser = Input::get('user');

		// if the user is a manager they will not have submitted a password for the user
		if(Utils::isManager()) {
			$postUser['password'] = $postUser['password_confirmation'] = substr(uniqid(), 0, 10);
		}

		$validator = Validator::make(
		    $postUser,
		    User::$rules
		);
		if(!$validator->fails()) {
			$user = new User;

			//check to see if a business is required for the user role
			$userRole = UserRole::find($postUser['user_role_id']);
			if($userRole->business_required) {
				//make sure that a business_id was submitted
				if(!isset($postUser['business_id'])) {
					return $this->error('A business id is required for this user type.');
				} else {
					$user->business_id = $postUser['business_id'];
				}
			}

			$user->user_role_id = $postUser['user_role_id'];
			$user->firstname = $postUser['firstname'];
			$user->lastname = $postUser['lastname'];
			$user->email = $postUser['email'];
			$user->work_phone = $postUser['work_phone'];
			if(isset($postUser['personal_phone'])) $user->personal_phone = $postUser['personal_phone'];
			$user->password = $user->lastname;

			if($user->save()) {
				return Response::json(array(
					'status' => 'ok',
					'message' => 'User successfully created'
				));
			} else {
				print_r($user->errors()->all());
			}
		} else {
			return $this->error($validator->messages()->toArray());
		}
	}

	/*
	 * Basic CRUD Update functionality
	 *
	 * @param int $id The id of the user to update
	 * @return json string
	 */
	public function updateUser($id) {

	}

	/*
	 * Basic CRUD Delete functionality
	 *
	 * @param int $id The id of the user to delete
	 * @return json string
	 */
	public function deleteUser($id) {

		$user = User::find($id);

		if(Utils::isSuperuser() || (Utils::isManager() && Auth::user()->business_id == $user->business_id)) {
			if($user->delete()) {
				return Response::json(array(
					'status' => 'ok',
					'message' => 'User successfully deleted.'
				));
			} else {
				return $this->error('There was a problem deleting the user.');
			}
		} else {
			return $this->error('You do not have permission to access that resource.');
		}

	}

	/*
	 * Functionality to get a list of roles
	 *
	 * @return json string
	 */
	public function userRoles() {
		$user = User::with('user_role')->find(Auth::user()->id);
		$roles = UserRole::where('weight','<=',$user->user_role->weight)->get();
		return Response::json(array(
			'status' => 'ok',
			'user_roles' => $roles->toArray()
		));
	}

}