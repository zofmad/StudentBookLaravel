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
        ['name' => "see-all-grades"],
        ['name' => "change-his/her-own-password"],
        ['name' => "see-statistics"],
        ['name' => "users-CRUD"],
        ['name' => 'classes-CRUD'],
        ['name' => "subjects-CRUD"],
        ['name' => "insert/update-grade-for-subject"],
        ['name' => "generate-CSV-file-with-grades"],
        ['name' => "see-grades-for-student"],
        ['name' => "see-grades-for-teacher"],
        ['name' => "see-subjects-for-teacher"],
        ['name' => "see-history-of-changes-for-teacher"],
        ['name' => "send-notification-email-to-student"],




      ]);
    }
}
