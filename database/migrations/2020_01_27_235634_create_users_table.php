<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('estacionamentos');

        Schema::create('estacionamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique()->notNullable();
            $table->string('password');
            $table->integer('estacionamento_id')->unsigned();
            $table->timestamps();

            $table->foreign('estacionamento_id')->references('id')->on('estacionamentos');
        });
        \App\Models\Estacionamento::create([
            'name' => 'park estacionamento'
        ]);

        \App\User::create([
            'name' => 'Daniel Souza',
            'email' => 'daniell.oliveirra@gmail.com',
            'password' => app('hash')->make('123456'),
            'estacionamento_id' => 1
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('estacionamentos');
    }
}
