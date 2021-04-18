<?php

use App\Tweet;
use App\User;
use Illuminate\Database\Seeder;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
	    	Tweet::create([
	            'text' => $faker->text(140),
                'user_id' =>  User::all()->random()->id,
	        ]);
    	}
    }
}
