<?php

use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->insert([
            ['title' => 'About Us','content'=>'About Us'],
            ['title'=>'Privacy Policy','content'=>'Privacy Policy'],
            ['title'=>'T&C','content'=>'T&C'],
            ['title'=>'Introduction','content'=>'Introduction'],
        ]);
    }
}
