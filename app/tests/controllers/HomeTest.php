<?php

class HomeTest extends TestCase {

	public function testDashboard() {
		print("HomeTest -- Dashboard \r\n");
		$user = User::find(1);

		$this->be($user);

		$this->call('GET','/');

		$this->assertResponseOk();
	}

	public function testShowLogin() {
		print("HomeTest -- Login \r\n");
		$this->call('GET','/login');

		$this->assertResponseOk();
	}

	public function testPostLoginCorrect() {
		print("HomeTest -- PostLoginCorrect \r\n");

		$user = array(
			"email" => "niel@test.com",
			"password" => "password"
		);

		$response = $this->action('POST','HomeController@postLogin',$user);

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok'); 

		$this->assertTrue($jsonObject->message == 'User validated'); 
	}

	public function testPostLoginNoCreds() {
		print("HomeTest -- PostLoginNoCreds \r\n");

		$response = $this->action('POST','HomeController@postLogin');

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'error'); 

		$this->assertCount(2,$jsonObject->message); 

		$this->assertTrue($jsonObject->message[0] == 'The email field is required.');

		$this->assertTrue($jsonObject->message[1] == 'The password field is required.');
	}

	public function testPostLoginIncorrect() {
		print("HomeTest -- PostLoginIncorrect \r\n");

		$user = array(
			"email" => "niel@test.com",
			"password" => "1234"
		);

		$response = $this->action('POST','HomeController@postLogin',$user);

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'error');

		$this->assertTrue($jsonObject->message == 'Email/Password is incorrect');
	}

	public function testLogout() {
		print("HomeTest -- Logout \r\n");	

		$user = User::find(1);
		$this->be($user);

		$response = $this->action('GET','HomeController@logout');

		$jsonObject = json_decode($response->getContent());

		//correct json response
		$this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		$this->assertTrue($jsonObject->status == 'ok');

		$this->assertTrue($jsonObject->message == 'Successfully logged out');

		$this->assertFalse(Auth::check());
	}

	public function testShowRegistration() {
		print("HomeTest -- Registration \r\n");

		$this->call('GET','/register');

		$this->assertResponseOk();
	}

	public function testPostRegistrationCorrect() {
		print("HomeTest -- RegistrationCorrect \r\n");

		// $user = array(
		// 	"accessCode" => "TW9651212TW",
		// 	"firstname" => "Bob",
		// 	"lastname" => "Krandall",
		// 	"email" => "bkrandall@test.com",
		// 	"password" => "password",
		// 	"password_confirmation" => "password",
		// 	"work_phone" => "5555551212",
		// );

		// $response = $this->action('POST','HomeController@postRegistration',$user);

		// $jsonObject = json_decode($response->getContent());

		// //correct json response
		// $this->assertTrue(json_last_error() == JSON_ERROR_NONE);

		// print_r($jsonObject->message);

		// $this->assertTrue($jsonObject->status == 'error');
	}

}