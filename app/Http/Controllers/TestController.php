<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        $user = new \App\Models\User();
         var_dump($user);

        $permission = new \App\Models\Role();
        var_dump($permission);
//         $director->name = 'Director';
//         $director->display_name = "Director";
//         $director->description = "Director role-can see all grades, manage teachers and students accounts".
//         " (full CRUD with password change), can change his/her own password, add classes and assign students to them (full CRUD),".
//         " add subjects and assign them to teachers and classes(full CRUD), see statistics (ex. number of grades for teacher/subject/class)";


        //
        // $director->save();
        // var_dump($director);
    }
}