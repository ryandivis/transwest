<?php

class TicketsTest extends TestCase {

	public function testGetTickets() {
		print("TicketsTest -- getTickets \r\n");

		$user = User::find(1);

		$this->be($user);

		$response = $this->action('GET','TicketsController@getTickets');

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok');

		$this->assertCount(3,$jsonObject->tickets->open);

		$this->assertCount(3,$jsonObject->tickets->pending);

		$this->assertCount(2,$jsonObject->tickets->closed);
	}

	public function testGetTicketsUser() {
		print("TicketsTest -- getTicketsUser \r\n");

		$user = User::find(3);

		$this->be($user);

		$response = $this->action('GET','TicketsController@getTickets');

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok');

		$this->assertCount(1,$jsonObject->tickets->open);

		$this->assertCount(1,$jsonObject->tickets->pending);

		$this->assertCount(2,$jsonObject->tickets->closed);	
	}

	public function testGetTicketsSupervisor() {
		print("TicketsTest -- getTicketsSupervisor \r\n");	

		$user = User::find(2);

		$this->be($user);

		$response = $this->action('GET','TicketsController@getTickets');

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok');

		$this->assertCount(2,$jsonObject->tickets->open);

		$this->assertCount(2,$jsonObject->tickets->pending);

		$this->assertCount(2,$jsonObject->tickets->closed);	
	}

	public function testGetTicket() {
		print("TicketsTest -- getTicket \r\n");	

		$user = User::find(1);

		$this->be($user);

		$response = $this->action('GET','TicketsController@getTicket',array(1));

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok');

		$this->assertTrue(is_object($jsonObject->ticket));
	}

	public function testGetTicketFail() {
		print("TicketsTest -- getTicketFail \r\n");	

		$user = User::find(3);

		$this->be($user);

		$response = $this->action('GET','TicketsController@getTicket',array(3));

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'error');

		$this->assertTrue($jsonObject->message == 'You do not have permission to access ticket #3');
	}

	public function testAddTicketCommentFail() {
		print("TicketsTest -- addTicketCommentFail \r\n");	

		$user = User::find(3);

		$this->be($user);

		$response = $this->action('POST','TicketsController@addTicketComment',array(3));

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'error');

		$this->assertTrue($jsonObject->message == 'You do not have permission to add a comment.');
	}

	public function testAddTicketCommentNoComment() {
		print("TicketsTest -- addTicketCommentNoComment \r\n");	

		$user = User::find(1);

		$this->be($user);

		$response = $this->action('POST','TicketsController@addTicketComment',array(3));

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'error');

		$this->assertTrue($jsonObject->message == 'You must submit a comment.');
	}

	public function testAddTicketComment() {
		print("TicketsTest -- addTicketComment\r\n");	

		$user = User::find(1);

		$this->be($user);

		$post = array(
			3,
			'comment' => array(
				'ticket_id' => 1,
				'user_id' => $user->id,
				'comment' => 'A test comment'
			)
		);

		$response = $this->action('POST','TicketsController@addTicketComment',$post);

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok');

		$this->assertTrue($jsonObject->message == 'Comment successfully added');
	}

	public function testApproveTicketFail() {
		print("TicketsTest -- approveTicketFail\r\n");	

		$user = User::find(3);

		$this->be($user);

		$response = $this->action('PUT','TicketsController@approveTicket',array(3));

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'error');

		$this->assertTrue($jsonObject->message == 'You do not have permission to approve this ticket.');
	}

	public function testApproveTicket() {
		print("TicketsTest -- approveTicket\r\n");	

		$user = User::find(1);

		$this->be($user);

		$response = $this->action('PUT','TicketsController@approveTicket',array(3));

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok');

		$this->assertTrue($jsonObject->message == 'The ticket has been approved');
	}

	public function testCreateTicketNoTicket() {
		print("TicketsTest -- Create Ticket No Ticket \r\n");	

		$user = User::find(1);

		$this->be($user);

		$response = $this->action('POST','TicketsController@createTicket');

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertEquals(json_last_error(),JSON_ERROR_NONE);

		$this->assertEquals($jsonObject->status,'error');

		$this->assertEquals($jsonObject->message,'You must submit a valid issue.');
	}

	public function testCreateTicketNotAuthorized() {
		print("TicketsTest -- Create Ticket Not Authorized \r\n");	

		$user = User::find(3);

		$this->be($user);

		$post = array(
			"issue" => "Test issue",
			"user_id" => 1
		);

		$response = $this->action('POST','TicketsController@createTicket',$post);

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertEquals(json_last_error(),JSON_ERROR_NONE);

		$this->assertEquals($jsonObject->status,'error');

		$this->assertEquals($jsonObject->message,'You do not have permission to submit tickets as that user.');
	}

	public function testCreateTicket() {
		print("TicketsTest -- Create Ticket \r\n");

		$user = User::find(3);

		$this->be($user);

		$post = array(
			"issue" => "Test issue",
			"user_id" => 3
		);

		$response = $this->action('POST','TicketsController@createTicket',$post);

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertEquals(json_last_error(),JSON_ERROR_NONE);

		$this->assertEquals($jsonObject->status,'ok');

		$this->assertEquals($jsonObject->message,'Ticket successfully added.');
	}

}