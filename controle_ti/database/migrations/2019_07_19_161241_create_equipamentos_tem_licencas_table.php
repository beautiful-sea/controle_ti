<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosTemLicencasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos_tem_licencas', function (Blueprint $table) {
            $table->unsignedBigInteger('equipamentos_id');
            $table->unsignedBigInteger('licencas_id');
            $table->timestamps();

            $table->foreign('equipamentos_id')
              ->references('id')->on('equipamentos')
              ->onDelete('cascade');

            $table->foreign('licencas_id')
              ->references('id')->on('licencas')
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
        Schema::dropIfExists('equipamentos_tem_licencas');
    }
}
