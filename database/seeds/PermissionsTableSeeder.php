<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('permissions')->insert([
        ['name' => "See all grades"],
        ['name' => "Change his/her own password"],
        ['name' => "See statistics"],
        ['name' => "Users CRUD"],
        ['name' => "Classes CRUD"],
        ['name' => "Subjects CRUD"],
        ['name' => "Insert/update grade for subject"],
        ['name' => "Generate CSV file"],
        ['name' => "See grades for student"],
        ['name' => "See grades for teacher"]

      ]);
    }
}
