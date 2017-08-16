<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
          'name' => "Jan Kowalski",
          'email' => "jan.kowalski@gmail.com",
          'password' => Hash::make('secret'),
      ]);
    }
}
