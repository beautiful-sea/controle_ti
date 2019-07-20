<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipamento_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('cadastrante_id')->nullable();
            $table->unsignedBigInteger('setor_id');
            $table->text('descricao');
            $table->text('img_extension')->nullable();
            $table->dateTime('resolucao')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('equipamento_id')
              ->references('id')->on('equipamentos');

              $table->foreign('usuario_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

              $table->foreign('cadastrante_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

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
        Schema::dropIfExists('ordem_servicos');
    }
}
