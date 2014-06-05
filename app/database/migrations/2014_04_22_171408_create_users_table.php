<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('user_roles');
		Schema::dropIfExists('businesses');
		Schema::dropIfExists('access_codes');
		
		Schema::create('users',function($table){
			$table->increments('id');
			$table->integer('user_role_id');
			$table->integer('business_id')->nullable()->default(null);
			$table->integer('supervisor_id')->nullable()->default(null);
			$table->integer('vehicle_id')->nullable()->default(null);
			$table->string('firstname',100)->nullable()->default(null);
			$table->string('lastname',100)->nullable()->default(null);
			$table->string('email',100);
			$table->string('password',64);
			$table->string('work_phone',20)->nullable();
			$table->string('personal_phone',20)->nullable();
			$table->timestamps();
		});

		Schema::create('user_roles',function($table){
			$table->increments('id');
			$table->string('role',32);
			$table->integer('weight');
			$table->boolean('business_required')->nullable()->default(1);
			$table->timestamps();
		});

		Schema::create('businesses',function($table){
			$table->increments('id');
			$table->string('name',100);
			$table->string('phone',20)->nullable();
			$table->timestamps();
		});

		Schema::create('access_codes',function($table){
			$table->increments('id');
			$table->integer('business_id');
			$table->integer('supervisor_id');
			$table->integer('user_role_id');
			$table->string('code',12);
			$table->timestamps();
		});

		//insert roles into the database
		$superAdmin = UserRole::create(array(
			'role' => 'Super Admin',
			'weight' => 100,
			'business_required' => false
		));
		$vehicleManager = UserRole::create(array(
			'role' => 'Vehicle Manager',
			'weight' => 50
		));
		$mechanic = UserRole::create(array(
			'role' => 'Mechanic',
			'weight' => 75,
			'business_required' => false
		));
		UserRole::create(array(
			'role' => 'Supervisor',
			'weight' => 20
		));
		UserRole::create(array(
			'role' => 'Driver',
			'weight' => 10
		));

		//add first access code
		DB::table('access_codes')->insert(array(
			'business_id' => 0,
			'supervisor_id' => 0,
			'user_role_id' => $superAdmin->id,
			'code' => 'TW9651212TW'
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('user_roles');
		Schema::dropIfExists('bussinesses');
		Schema::dropIfExists('access_codes');
	}

}
