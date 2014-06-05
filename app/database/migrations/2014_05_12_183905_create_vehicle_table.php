<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicles', function($table){
			$table->increments('id');
			$table->integer('business_id');
			$table->string('fleet_id');
			$table->string('vin')->nullable();
			$table->integer('year')->nullable();
			$table->string('make')->nullable();
			$table->string('model')->nullable();
			$table->string('engine')->nullable();
			$table->timestamps();
		});

		Schema::create('mileage',function($table){
			$table->increments('id');
			$table->integer('vehicle_id');
			$table->integer('mileage');
			$table->integer('created_by');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('vehicles');
		Schema::dropIfExists('mileage');
	}

}
