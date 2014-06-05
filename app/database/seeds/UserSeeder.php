<?php

class UserSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		$superAdmin = UserRole::where('role','Super Admin')->first();
		$supervisor = UserRole::where('role','Supervisor')->first();
		$user = UserRole::where('role','Driver')->first();

		$divisInc = Business::where('name','Divis INC')->first();
		$comcast = Business::where('name','Comcast')->first();

		$vehicles = Vehicle::get();

		User::create(array(
			'user_role_id' => $superAdmin->id,
			'firstname' => 'Niel',
			'lastname' => 'Townsend',
			'email' => 'niel@test.com',
			'password' => Hash::make('password')
		));

		User::create(array(
			'user_role_id' => $supervisor->id,
			'business_id' => $divisInc->id,
			'vehicle_id' => $vehicles[0]->id,
			'firstname' => 'Danielle',
			'lastname' => 'Divis',
			'email' => 'danielle@test.com',
			'password' => Hash::make('password'),
			'work_phone' => '5555551212'
		));

		$supervisorUser = User::where('firstname','Danielle')
			->where('lastname','Divis')
			->first();

		User::create(array(
			'user_role_id' => $user->id,
			'business_id' => $divisInc->id,
			'vehicle_id' => $vehicles[1]->id,
			'supervisor_id' => $supervisorUser->id,
			'firstname' => 'Ryan',
			'lastname' => 'Divis',
			'email' => 'ryan@test.com',
			'password' => Hash::make('password'),
			'work_phone' => '5555551213'
		));

		User::create(array(
			'user_role_id' => $supervisor->id,
			'business_id' => $comcast->id,
			'vehicle_id' => $vehicles[2]->id,
			'firstname' => 'Bob',
			'lastname' => 'Krandall',
			'email' => 'bob@test.com',
			'password' => Hash::make('password'),
			'work_phone' => '5555551213'
		));
		
	}

}