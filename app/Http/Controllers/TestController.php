<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Role;



class TestController extends Controller
{
    public function index()
    {
        // $user = new \App\Models\User();
        //  var_dump($user);
       // 
      //  //
      //    DB::table('users')->insert([
      //        'name' => "teacher",
      //        'email' => "teacher@gmail.com",
      //        'password' => \Hash::make('tsecret'),
      //    ]);
      //    $teacher = User::where('name', '=', 'teacher')->first();
      //    $role = Role::where('name', '=', 'Teacher')->first();
      //   $teacher->attachRole($role);
      //   $teacher->save();
      //   DB::table('users')->insert([
      //       'name' => "student",
      //       'email' => "student@gmail.com",
      //       'password' => \Hash::make('ssecret'),
      //   ]);
      //   $teacher = User::where('name', '=', 'student')->first();
      //   $role = Role::where('name', '=', 'Student')->first();
      //  $teacher->attachRole($role);
      //  $teacher->save();
      //  //
       //
       //
      //   $permission = new \App\Models\Permission();
      //   var_dump($permission);
      //   $role = new \App\Models\Role();
      //    var_dump($role);
       //
      //   $permission = new \App\Models\Subject();
      //   var_dump($permission);
      //   $permission = new \App\Models\Classroom();
      //   var_dump($permission);
       //
       //
      //                           $permission = new \App\Models\Grade();
      //                           var_dump($permission);
       //
      //                                   $permission = new \App\Models\GradesHistory();
      //                                   var_dump($permission);

//         $director->name = 'Director';
//         $director->display_name = "Director";
//         $director->description = "Director role-can see all grades, manage teachers and students accounts".
//         " (full CRUD with password change), can change his/her own password, add classes and assign students to them (full CRUD),".
//         " add subjects and assign them to teachers and classes(full CRUD), see statistics (ex. number of grades for teacher/subject/class)";


        //
        // $director->save();
        // var_dump($director);
// INSERT INTO `grades` (`id`, `student_id`, `subject_id`, `note`, `value`, `created_at`, `updated_at`) VALUES ('1', '2', '1', NULL, '3', NULL, NULL);


    }
}
