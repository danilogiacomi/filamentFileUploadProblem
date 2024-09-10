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
                'name' => 'user',
                'email' => 'user@example.org',
                'email_verified_at' => NULL,
                'password' => '$2y$12$pKtV3zMpaNixSAEVimezBe.o8VGtxHGsRMTJCVX0fcIbhM.dgESZS',
                'remember_token' => NULL,
                'created_at' => '2024-09-10 07:14:34',
                'updated_at' => '2024-09-10 07:14:34',
            ),
        ));

        
    }
}