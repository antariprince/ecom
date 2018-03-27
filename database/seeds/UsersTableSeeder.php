<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        	'name' => 'admin',
        	'password' => bcrypt('admin'),
        	'email' => 'tj.module.test@gmail.com',
        	'admin' => 1,
        	'avatar' => asset('uploads/avatars/screenshot.jpg')
        ]);

        App\User::create([
            'name' => 'sheldon cooper',
            'password' => bcrypt('password'),
            'admin' => 1,
            'email' => 'tj.module.test2@gmail.com',
            'avatar' => asset('uploads/avatars/screenshot.jpg')
        ]);
    }
}
