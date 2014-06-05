<?php

class VehiclesController extends BaseController {

	/*
	 * Basic CRUD Create functionality
	 *
	 * @return json string
	 */
	public function createVehicle() {
		if(Utils::isManager()) {
			$postVehicle = Input::get('vehicle');
			$validator = Validator::make(
			    $postVehicle,
			    Vehicle::$rules
			);
			if(!$validator->fails()) {
				$vehicle = Vehicle::create($postVehicle);
				if($vehicle) {
					//save the mileage
					if(Input::has('mileage')) {
						$mileage = Input::get('mileage');
						$fields = array(
									'vehicle_id' => $vehicle->id,
									'mileage' => $mileage['mileage'],
									'created_by' => Auth::user()->id
								);
						$validator = Validator::make(
							$fields,
							Mileage::$rules
						);
						if(!$validator->fails()) {
							Mileage::create($fields);
						}
					}
					return Response::json(array(
						'status' => 'ok',
						'message' => 'Vehicle created successfully.'
					));
				} else {
					return $this->error('There was a problem saving the vehicle.');
				}
			} else {
				return $this->error($validator->messages()->toArray());
			}
		} else {
			return $this->error('You do not have permission to access this resource.');
		}
	}

	/*
	 * Basic CRUD Read functionality
	 *
	 * @param integer $id Id of the vehicle to read
	 * @return json string
	 */
	public function getVehicle($id) {
		$vehicle = Vehicle::with(array(
			'business',
			'mileage',
			'driver'
		))->find($id);
		return Response::json(array(
			'status' => 'ok',
			'vehicle' => $vehicle->toArray()
		));
	}

	/*
	 * Basic CRUD Update functionality
	 *
	 * @param integer $id Id of the vehicle to update
	 * @return json string
	 */
	public function updateVehicle($id) {

	}

	/*
	 * Basic CRUD Delete functionality
	 *
	 * @param integer $id Id of the vehicle to delete
	 * @return json string
	 */
	public function deleteVehicle($id) {
		$vehicle = Vehicle::find($id);
		if(Utils::isSuperuser() || (Utils::isManager() && Auth::user()->business_id == $vehicle->business_id)) {
			if($vehicle->delete()) {
				return Response::json(array(
					'status' => 'ok',
					'message' => 'Vehicle successfully deleted'
				));
			} else {
				return $this->error('There was an error deleting the vehicle.');
			}
		} else {
			return $this->error('You do not have permission to delete that vehicle.');
		}
	}
}