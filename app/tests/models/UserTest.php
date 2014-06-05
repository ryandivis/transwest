<?php

class UserTest extends TestCase {
	public function testRquiredFields() {

		$userArray = array(
			'user_role_id' => 1,
			'email' => 'ryandivis@yahoo.com',
			'password' => 'password'
		);

		$validator = Validator::make(
			$userArray,
			User::$rules
		);

		$this->assertTrue($validator->fails());

		$errors = $validator->errors()->all();

		$this->assertCount(5,$errors);

		$this->assertEquals($errors[0],"The firstname field is required.");

		$this->assertEquals($errors[1],"The lastname field is required.");

		$this->assertEquals($errors[2],"The password confirmation does not match.");

		$this->assertEquals($errors[3],"The password confirmation field is required.");

		$this->assertEquals($errors[4],"The work phone field is required.");
	}

	public function testUserCreate() {
		$userArray = array(
			'user_role_id' => 1,
			'firstname' => 'Ryan',
			'lastname' => 'Divis',
			'email' => 'ryandivis@yahoo.com',
			'password' => 'password',
			'password_confirmation' => 'password',
			'work_phone' => '5555551212'
		);

		$validator = Validator::make(
			$userArray,
			User::$rules
		);


		$this->assertFalse($validator->fails());	
	}

	public function testSeedWorked() {
		$user = User::find(1);

		$this->assertTrue($user->firstname === 'Niel');
	}
}