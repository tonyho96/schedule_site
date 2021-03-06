<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groomers', function (Blueprint $table) {
             $table->integer('id', true);
            $table->integer('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone', 45)->nullable();
            $table->string('work_phone', 45)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('town')->nullable();
            $table->string('country_state')->nullable();
            $table->string('post_zip_code')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('groomers');
    }
}
