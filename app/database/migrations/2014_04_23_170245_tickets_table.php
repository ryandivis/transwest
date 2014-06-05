<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('business_id');
			$table->string('issue',1000);
			$table->boolean('approved')->default(0);
			$table->integer('approved_by')->nullable()->default(null);
			$table->datetime('approved_timestamp')->nullable();
			$table->boolean('scheduled')->nullable()->default(0);
			$table->integer('scheduled_by')->nullable()->default(null);
			$table->datetime('scheduled_timestamp')->nullable();
			$table->integer('event_id')->nullable();
			$table->boolean('resolved')->default(0);
			$table->integer('resolved_by')->nullable()->default(null);
			$table->datetime('resolved_timestamp')->nullable();
			$table->boolean('closed')->default(0);
			$table->integer('closed_by')->nullable();
			$table->datetime('closed_timestamp')->nullable();
			$table->timestamps();
		});

		Schema::create('comments',function($table){
			$table->increments('id');
			$table->integer('ticket_id');
			$table->integer('user_id');
			$table->string('comment',1000);
			$table->timestamps();
		});

		Schema::create('events',function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->string('title',100);
			$table->string('desc',1000)->nullable();
			$table->string('location',120)->nullable();
			$table->datetime('date');
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
		Schema::dropIfExists('tickets');
		Schema::dropIfExists('comments');
		Schema::dropIfExists('events');
	}

}
