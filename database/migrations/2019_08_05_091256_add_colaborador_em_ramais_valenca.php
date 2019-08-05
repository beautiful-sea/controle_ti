<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColaboradorEmRamaisValenca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ramais_valenca', function (Blueprint $table) {
            $table->unsignedBigInteger('usuarios_id')->nullable();

            $table->foreign('usuarios_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ramais_valenca', function (Blueprint $table) {
            $table->dropColumn('usuarios_id');
        });
    }
}
