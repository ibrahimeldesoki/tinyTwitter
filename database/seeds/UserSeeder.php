<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserSeeder extends Seeder
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
	    	User::create([
	            'name' => $faker->name(),
	            'email' => $faker->email(),
	            'password' => Hash::make('12345678'),
                'date_of_birth' => '2000-01-01',
                'image' =>   $faker->image('public/upload/user/images',400,300, 'people', false),
	        ]);
    	}
    }
}
