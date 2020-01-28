<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('checkins');
        Schema::create('checkins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placa', 7);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamp('dataCheckout')->nullable();
            $table->double('valor')->unsigned()->nullable();;
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkins');
    }
}
