<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('appointments', function(Blueprint $table)
		{
			$table->foreign('pet_id', 'fk_appointments_pets')->references('id')->on('pets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('groomer_id', 'fk_appointments_groomers')->references('id')->on('groomers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('appointments', function(Blueprint $table)
		{
			$table->dropForeign('fk_appointments_pets');
			$table->dropForeign('fk_appointments_groomers');
		});
	}

}
