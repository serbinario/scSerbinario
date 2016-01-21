<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->integer('operacoes_id')->unsigned();
            $table->foreign('operacoes_id')->references('id')->on('operacoes');
            $table->string('validacao');
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
        Schema::drop('campos');
    }
}
