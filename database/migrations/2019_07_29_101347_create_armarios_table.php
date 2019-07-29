<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero');
            $table->unsignedBigInteger('usuarios_id')->nullable();
            $table->integer('local');

            $table->foreign('usuarios_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('armarios');
    }
}
