<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->truncate();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'danilo',
                'email' => 'giacomi@netseven.it',
                'email_verified_at' => NULL,
                'password' => '$2y$12$H6CXHhNb8ty26ue6y9SPvu0l08mDe5eruUOH0BVLpTcJzxsv8UwmG',
                'remember_token' => NULL,
                'created_at' => '2024-09-09 09:55:00',
                'updated_at' => '2024-09-09 09:55:00',
            ),
        ));

        
    }
}