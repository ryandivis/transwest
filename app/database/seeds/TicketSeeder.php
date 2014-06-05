<?php

class TicketSeeder extends Seeder {

	public function run()
	{
		DB::table('tickets')->delete();

		$date = new \DateTime;

		$user = User::where('firstname','Ryan')
			->where('lastname','Divis')
			->first();

		$supervisor = User::where('firstname','Danielle')
			->where('lastname','Divis')
			->first();

		$superAdmin = User::where('firstname','Niel')
			->where('lastname','Townsend')
			->first();

		$krandall = User::where('email','bob@test.com')->first();

		Ticket::create(array(
			"user_id" => $user->id,
			"business_id" => $user->business_id,
			"issue" => "Truck is not turning over every time."
		));

		Ticket::create(array(
			"user_id" => $supervisor->id,
			"business_id" => $supervisor->business_id,
			"issue" => "Truck is running really rough."
		));

		Ticket::create(array(
			"user_id" => $krandall->id,
			"business_id" => $krandall->business_id,
			"issue" => "Truck is running really rough."
		));

		$ticket = Ticket::create(array(
			"user_id" => $supervisor->id,
			"business_id" => $supervisor->business_id,
			"issue" => "Brakes need some work.",
			"approved" => true,
			"approved_by" => $supervisor->id,
			"approved_timestamp" => $date,
			"scheduled" => true,
			"scheduled_by" => $supervisor->id,
			"scheduled_timestamp" => $date
		));

		$ticket = Ticket::create(array(
			"user_id" => $krandall->id,
			"business_id" => $krandall->business_id,
			"issue" => "Brakes need some work.",
			"approved" => true,
			"approved_by" => $krandall->id,
			"approved_timestamp" => $date,
			"scheduled" => true,
			"scheduled_by" => $superAdmin->id,
			"scheduled_timestamp" => $date
		));

		Comment::create(array(
			"user_id" => $supervisor->id,
			"ticket_id" => $ticket->id,
			"comment" => 'Needs new windshield wipers as well'
		));

		Comment::create(array(
			"user_id" => $superAdmin->id,
			"ticket_id" => $ticket->id,
			"comment" => "We just recently did work on this vehicle's brakes. We will look into the problem, but I don't think the break pads will need to be changed."
		));

		Ticket::create(array(
			"user_id" => $user->id,
			"business_id" => $user->business_id,
			"issue" => "Truck is really difficult to steer. Power steering seems like it went out.",
			"approved" => true,
			"approved_by" => $supervisor->id,
			"approved_timestamp" => $date
		));

		Ticket::create(array(
			"user_id" => $user->id,
			"business_id" => $user->business_id,
			"issue" => "Radiator leaking all over the place.",
			"approved" => true,
			"approved_by" => $supervisor->id,
			"approved_timestamp" => $date,
			"resolved" => true,
			"resolved_by" => $superAdmin->id,
			"resolved_timestamp" => $date
		));

		Ticket::create(array(
			"user_id" => $user->id,
			"business_id" => $user->business_id,
			"issue" => "Needs an oil change.",
			"closed" => true,
			"closed_by" => $supervisor->id,
			"closed_timestamp" => $date
		));
	}

}