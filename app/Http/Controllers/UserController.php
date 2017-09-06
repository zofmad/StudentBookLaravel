<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  string $role
     * @return \Illuminate\Http\Response
     */
    public function index(string $role)
    {


      $users = User::all();

      $usersWithRole = [];
      for($i=0; $i<count($users); $i++){
        if($users[$i]->hasRole($role)){
          $usersWithRole[] = $users[$i];
        }
      }

      return view('user.list', ['role' => $role])
      ->withUsers($usersWithRole);
    }

    /**
     * Show the form for creating a new resource.
     * @param  string $role
     * @return \Illuminate\Http\Response
     */
    public function create(string $role)
    {
      $classes = null;
      $subjects = null;
      if($role == 'Teacher'){
        $subjects = Subject::all();
        $subjects = array_pluck($subjects, 'name', 'id');
      }


      if($role == 'Student'){
        $classes = Classroom::all();
        $classes = array_pluck($classes, 'name', 'id');
      }

      return view('user.create', ['role' => $role, 'classes' => $classes, 'subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'role' => 'required'
      ]);
      if($request->input('role') == 'Student'){

        $this->validate($request, [
          'usertable_id' => 'required|numeric|min:1',
          'usertable_type' => ['required', Rule::in(['class']),],
        ]);
      }



      $newUser = $request->all();

      $user = User::create($newUser);
      $role = Role::where('name', '=', $request->input('role'))->first();
      $user->attachRole($role);

      $user->save();
      if($request->input('role') == 'Teacher' && $request->input('subject_ids')){
          foreach($request->input('subject_ids') as $subjectId){
            $subject = Subject::where('id', '=', $subjectId)->first();
            $subject->teacher_id = $user->id;
            $subject->save();

          }

      }


      // \Session::flash('flash_message', $newUser['role']." ".$newUser['name']." successfully added!");
      return redirect()->back()
      ->with('flash_message', $newUser['role']." ".$newUser['name']." successfully added!");
    }
    /**
     * Display the specified resource.
     * @param  string $role
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(string $role = null, User $user = null)
    {


      if($user->id == null){
        $user = \Auth::user();

      }
      if($user->id == \Auth::user()->id){
        $role = "me";
      }

      // if($role == null){
      //   $role = $user->roles->first()->name;
      // }
      $userId = $user->id;
      $user = User::findOrFail($userId);
      $class = null;
      if($role == "Student"){
        if($user->usertable_type == 'class'){
          $class = Classroom::where('id', '=', $user->usertable_id)->first();

        }

      }
      $subjects = null;
      if($role == "Teacher"){
          $subjects = Subject::where('teacher_id', '=', $user->id)->get();
//          $subjects = array_pluck($subjects, 'name', "id");

      }


      return view('user.show', ['user' => $user, 'class' => $class, "subjects" => $subjects])->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $role
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(string $role = null, User $user)
    {
      $userId = $user->id;
      $user = User::findOrFail($userId);
      // if($role == null){
      //   $role = \Auth::user()->roles->first()->name;
      // }


      $classes = null;
      $subjects = null;
      if($role == 'Teacher'){

        $subjects = Subject::where('teacher_id', '!=', $userId)->get();

        $subjects = array_pluck($subjects, 'name', 'id');

      }


      if($role == 'Student'){
        $classes = Classroom::all();
        $classes = array_pluck($classes, 'name', 'id');
      }
      return view('user.edit', ['user' => $user, 'classes' => $classes, 'subjects' => $subjects])->withRole($role);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {

      $userId = $user->id;
      $user = User::findOrFail($userId);

      // var_dump($request);
      // die();
      $this->validate($request, [
        'name' => 'required',
        'email' => ['required',
          Rule::unique('users')->ignore($user->id),
        ]
      ]);
      if($request->input('role') == 'Student'){

        $this->validate($request, [
          'usertable_id' => 'required|numeric|min:1',
          'usertable_type' => ['required', Rule::in(['class']),],
        ]);
      }

      if($request->input('role') == 'Teacher' && $request->input('subject_ids')){

           foreach($request->input('subject_ids') as $subjectId){
            $subject = Subject::where('id', '=', $subjectId)->first();
            $subject->teacher_id = $user->id;
            $subject->save();

          }

      }

      if($request->input('email') == $user->email && $request->input('name') == $user->name
        && (!$request->input('usertable_id') || $request->input('usertable_id') == $user->usertable_id)
        && (!$request->input('subject_ids')) ) {

        return redirect()->back()->with('warning_message', "You didn't change any data.");
      }

      $updatedUser = $request->all();
      // $role = $user->roles->first()->name;
      $role = $request->input('role');

      $user->fill($updatedUser)->save();


      return redirect()->back()->with('flash_message', "$role successfully updated!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $role
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function changePassword(string $role = null, User $user = null)
    {
      $userId = $user->id;
      $user = User::findOrFail($userId);
      // if($role == null){
      //   $role = \Auth::user()->roles->first()->name;
      // }
      return view('user.changePassword', ['user' => $user])->withRole($role);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(User $user, Request $request)
    {

      $userId = $user->id;
      $user = User::findOrFail($userId);

      // var_dump($request);
      // die();

      ///logika zmiany hasla...

      $formCorrect = true;
      $warningMessage = '';
      if(!\Entrust::can('users-CRUD')){

        if(!\Hash::check($request->input('old_password'), $user->password)) {

          $warningMessage .= "Old password is incorrect.";
          $formCorrect = false;

        }
      }
      if(\Hash::check($request->input('new_password'), $user->password)) {

        $warningMessage .= "New password is the same as old password.";
        $formCorrect = false;

      }

      if(strlen($request->input('new_password')) < 10) {
        $warningMessage .= "Password has to have minimum length of 10 characters.";
        $formCorrect = false;

      }
      if($request->input('new_password') != $request->input('repeat_password')) {
        $warningMessage .= "New password and Repeat password doesn't match.";
        $formCorrect = false;

      }


      if(!$formCorrect){
        return redirect()->back()->with('warning_message', $warningMessage);


      }


      $updatedUser = $request->all();
      // $role = $user->roles->first()->name;
      $role = $request->input('role');
        $updatedUser['password'] = \Hash::make($request->input('new_password'));
      $user->fill($updatedUser)->save();

      return redirect()->back()->with('flash_message', "Password successfully changed.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $userId = $user->id;
        $user = User::findOrFail($userId);
        $role = $user->roles->first()->name;
        $authId =  \Auth::user()->id;
        $user->delete();
        if($userId == $authId){

          return redirect()->route('home');
        }
        return redirect()->route('user.list.role', $role)
          ->with('flash_message', "$role successfully deleted!");
    }
}
