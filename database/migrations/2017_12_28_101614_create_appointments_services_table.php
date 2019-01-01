<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments_services', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('appointment_id')->nullable()->index('fk_shedules_services_schedule_idx');
			$table->integer('service_id')->nullable()->index('fk_shedules_services_services_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('appointments_services');
	}

}
