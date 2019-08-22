<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
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

    	DB::table('messages')->insert([
    		'users_id' => $users->id,
    		'chats_id' => $chats->id,
    		'message'  => Str::random(20),
    		'created_at' => Carbon\Carbon::now(),
    		'updated_at' => Carbon\Carbon::now()
    	]);
    }
}
