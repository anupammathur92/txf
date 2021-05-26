<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'full_name' => 'TixFair',
            'email' => 'tixfair@yopmail.com',
            'role_id'=>'1',
            'status'=>'1',
            'password' => Hash::make('123456')
        ]);
    }
}
