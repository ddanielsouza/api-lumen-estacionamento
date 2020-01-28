<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracaoEstacionamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('configuracoesEstacionamentos');
        Schema::create('configuracoesEstacionamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('valorHora');
            $table->integer('estacionamento_id')->unsigned();
            $table->timestamps();

            $table->foreign('estacionamento_id')->references('id')->on('estacionamentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracoesEstacionamentos');
    }
}
