<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('BusinessSeeder');

		$this->command->info('Business table seeded');

		$this->call('VehicleSeeder');

		$this->command->info('Vehicles table seeded');

		$this->call('UserSeeder');

		$this->command->info('Users table seeded');

		$this->call('TicketSeeder');

		$this->command->info('Tickets table seeded');
	}

}
