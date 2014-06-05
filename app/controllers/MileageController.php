<?php

class MileageController extends BaseController {

	/*
	 * Basic CRUD Create functionality
	 *
	 * @return json string
	 */
	public function createMileage() {
		//managers and owners of a vehicle can create mileage
		if(Input::has('mileage')) {
			$postMileage = Input::get('mileage');
			$fields = array(
						'vehicle_id' => $postMileage['vehicle_id'],
						'mileage' => $postMileage['mileage'],
						'created_by' => Auth::user()->id
					);
			$validator = Validator::make(
				$fields,
				Mileage::$rules
			);
			if(!$validator->fails()) {
				if(Mileage::create($fields)) {
					return Response::json(array(
						'status' => 'ok',
						'message' => 'Mileage successfully saved'
					));
				} else {
					$this->error('There was an error saving the mileage');
				}
			} else {
				return $this->error($validator->messages()->toArray());
			}
		} else {
			return $this->error('Mileage information not received');
		}
	}

}