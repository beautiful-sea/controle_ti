<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatHasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_has_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('chats_id');

            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('chats_id')->references('id')->on('chats');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_has_users');
    }
}
