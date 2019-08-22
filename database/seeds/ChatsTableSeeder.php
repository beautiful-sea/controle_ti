<?php

use Illuminate\Database\Seeder;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = App\User::orderBy(\DB::raw('RAND()'))->first();

    	DB::table('chats')->insert([
    		'name' => Str::random(10),
    		'owner_id' => 2,
    		'created_at' => Carbon\Carbon::now(),
    		'updated_at' => Carbon\Carbon::now()
    	]);
    }
}
