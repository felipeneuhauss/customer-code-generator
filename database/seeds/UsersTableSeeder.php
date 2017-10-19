<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Felipe Neuhauss',
            'email' => 'neuhauss.inbox@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}