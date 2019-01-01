<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('customer_id')->nullable()->index('fk_petse_customers_idx');
			$table->integer('breed_id')->nullable()->index('fk_petse_breeds_idx');
			$table->string('name', 45)->nullable();
			$table->string('dob')->nullable();
			$table->string('gender')->nullable();
			$table->string('is_neutered', 45)->nullable();
			$table->string('image_url')->nullable();
			$table->string('note')->nullable();
			$table->string('alternative_contact_name')->nullable();
			$table->string('alternative_contact_number')->nullable();
            $table->string('cut_note')->nullable();
            $table->string('vet_name')->nullable();
            $table->string('vet_number')->nullable();
            $table->string('vet_address')->nullable();
            $table->string('vet_medical_note')->nullable();
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
		Schema::drop('pets');
	}

}
