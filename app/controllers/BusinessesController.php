<?php

class BusinessesController extends BaseController {

	public function businesses(){
		return View::make('businesses');
	}

	public function business($id) {
		$business = Business::find($id);
		return View::make('business')->with('business',$business);
	}

	public function myBusiness() {
		$business = Business::find(Auth::user()->business_id);
		return View::make('business')->with('business',$business);	
	}

	public function businessUsers($id,$type=null){
		if($type) {
			switch($type) {
				case 'supervisor':
					$userRole = UserRole::where('role','Supervisor')->first();
					break;
				default:
					$userRole = UserRole::where('role','Supervisor')->first();
					break;
			}
			$users = User::with('user_role','vehicle')->where('business_id',$id)->where('user_role_id',$userRole->id)->get();
		} else {
			$users = User::with('user_role','vehicle')->where('business_id',$id)->get();
		}

		//add actions
		if(Utils::isManager()) {
			foreach($users as $i => $user) {
				$user->actions = array(
					array(
						'name' => 'Edit',
						'url' => '/api/users'.$user->id,
						'method' => 'PUT'
					),
					array(
						'name' => 'Delete',
						'url' => '/api/users/'.$user->id,
						'method' => 'DELETE'
					)
				);
				$users[$i] = $user;
			}
		}

		return Response::json(array(
			'status' => 'ok',
			'users' => $users->toArray()
		));
	}

	public function businessVehicles($id) {
		$vehicles = Vehicle::with(array(
			'mileage' => function($query) {
				$query->orderBy('created_at','desc');
				return $query;
			},
			'driver'
		))->where('business_id',$id)->get();

		if(Utils::isManager()) {
			foreach($vehicles as $i => $vehicle) {
				$vehicle->actions = array(
					array(
						'name' => 'Edit',
						'url' => '/api/vehicles/'.$vehicle->id,
						'method' => 'PUT'
					),
					array(
						'name' => 'Delete',
						'url' => '/api/vehicles/'.$vehicle->id,
						'method' => 'DELETE'
					)
				);
				$vehicles[$i] = $vehicle;
			}
		}

		return Response::json(array(
			'status' => 'ok',
			'vehicles' => $vehicles->toArray()
		));
	}

	/*
	 * Basic CRUD Create functionality
	 *
	 * @return json string
	 */
	public function createBusiness() {
		if(Utils::isSuperuser()) {
			$business = new Business;

			if($business->validate(Input::all())) {
				$business->name = Input::get('name');
				$business->phone = Input::get('phone');
				$business->save();
				return Response::json(array(
					'status' => 'ok',
					'message' => 'Business successfully created'
				));
			}
			else
			{
				print_r($business->errors());
			}
		}
	}

	/*
	 * Basic CRUD Read functionality for one business
	 *
	 * @param int $id The id of the business to get
	 * @return json string
	 */
	public function getBusiness($id) {
		$business = Business::find($id);
		return Response::json(array(
			'status' => 'ok',
			'business' => $business->toArray()
		));
	}

	/*
	 * Basic CRUD Read functionality for businessList
	 *
	 * @return json string
	 */
	public function getBusinesses() {
		if(Utils::isSuperuser()) {
			$businesses = Business::get();
			//add actions
			foreach($businesses as $business) {

			}
			return Response::json(array(
				'status' => 'ok',
				'businesses' => $businesses->toArray()
			));
		} else {
			return $this->error('You do not have permissions to access that.');
		}
	}

	/*
	 * Basic CRUD Update functionality
	 *
	 * @param int $id The id of the business to update
	 * @return json string
	 */
	public function updateBusiness($id) {

	}

	/*
	 * Basic CRUD Delete functionality
	 *
	 * @param int $id The id of the business to delete
	 * @return json string
	 */
	public function deleteBusiness($id) {

	}

}