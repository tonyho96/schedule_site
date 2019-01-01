<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pets', function(Blueprint $table)
		{
			$table->foreign('customer_id', 'fk_petse_customers')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('breed_id', 'fk_petse_breeds')->references('id')->on('breeds')->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pets', function(Blueprint $table)
		{
			$table->dropForeign('fk_petse_customers');
		});
	}

}
