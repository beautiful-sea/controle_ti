<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFolhaPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folha_pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuarios_id');
            $table->string('extensao');
            $table->date('periodo');
            $table->timestamps();

            $table->foreign('usuarios_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folha_pagamentos');
    }
}
