<?php

class VehicleSeeder extends Seeder {

	public function run()
	{

		DB::table('vehicles')->delete();

		$businesses = Business::get();

		$vehicle1 = Vehicle::create(array(
			'business_id' => $businesses[0]->id,
			'fleet_id' => '1',
			'vin' => '4F2YU08102KM17887',
			'year' => 2002,
			'make' => 'Mazda',
			'model' => 'Tribute',
			'engine' => '3L V6'
		));

		$vehicle2 = Vehicle::create(array(
			'business_id' => $businesses[0]->id,
			'fleet_id' => '2',
			'vin' => '1N4AL3AP9DN441925',
			'year' => 2013,
			'make' => 'Nissan',
			'model' => 'Altima',
			'engine' => '2.5L Inline 4'
		));

		$vehicle3 = Vehicle::create(array(
			'business_id' => $businesses[1]->id,
			'fleet_id' => '19',
			'vin' => '1N4AL3AP9DN441925',
			'year' => 2013,
			'make' => 'Nissan',
			'model' => 'Altima',
			'engine' => '2.5L Inline 4'
		));

		//create mileages for the vehicles
		Mileage::create(array(
			'vehicle_id' => $vehicle1->id,
			'mileage' => 130000,
			'created_by' => 1
		));

		Mileage::create(array(
			'vehicle_id' => $vehicle2->id,
			'mileage' => 27000,
			'created_by' => 1
		));

		Mileage::create(array(
			'vehicle_id' => $vehicle2->id,
			'mileage' => 30000,
			'created_by' => 1
		));

	}

}
