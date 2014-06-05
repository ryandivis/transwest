<?php

class BusinessSeeder extends Seeder {

	public function run()
	{
		DB::table('businesses')->delete();

		Business::create(array(
			"name" => "Divis INC",
			"phone" => "555-555-1212"
		));

		Business::create(array(
			"name" => "Comcast",
			"phone" => "555-555-1212"
		));

		Business::create(array(
			"name" => "Dave's Trucking",
			"phone" => "555-555-1212"
		));
	}

}