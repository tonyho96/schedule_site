<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAppointmentsServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('appointments_services', function(Blueprint $table)
		{
			$table->foreign('appointment_id', 'fk_appointments_services_appointments')->references('id')->on('appointments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('service_id', 'fk_appointments_services_services')->references('id')->on('services')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('appointments_services', function(Blueprint $table)
		{
			$table->dropForeign('fk_appointments_services_appointments');
			$table->dropForeign('fk_appointments_services_services');
		});
	}

}
