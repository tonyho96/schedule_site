<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('start_date')->nullable();
			$table->time('start_time')->nullable();
			$table->date('end_date')->nullable();
			$table->time('end_time')->nullable();
			$table->integer('pet_id')->nullable()->index('fk_schedules_pets_idx');
			$table->integer('groomer_id')->nullable()->index('fk_schedules_groomers_idx');
			$table->integer('user_id')->nullable();
			$table->string('notes')->nullable();
			$table->string('status_1', 20)->nullable();
			$table->string('status_2', 20)->nullable();
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
		Schema::drop('appointments');
	}

}
