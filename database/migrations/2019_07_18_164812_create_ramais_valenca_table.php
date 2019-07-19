<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamaisValencaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramais_valenca', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ramal');
            $table->unsignedBigInteger('setor_id');
            $table->timestamps();

            $table->foreign('setor_id')
              ->references('id')->on('setores')
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
        Schema::dropIfExists('ramais_valenca');
    }
}
