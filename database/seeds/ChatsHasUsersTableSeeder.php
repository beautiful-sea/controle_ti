<?php

use Illuminate\Database\Seeder;

class ChatsHasUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::orderBy(\DB::raw('RAND()'))->first();
        $chats = App\Chat::orderBy(\DB::raw('RAND()'))->first();

    	DB::table('chat_has_users')->insert([
    		'users_id' => 2,
    		'chats_id' => 5,
    		'created_at' => Carbon\Carbon::now(),
    		'updated_at' => Carbon\Carbon::now()
    	]);
    }
}
