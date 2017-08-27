<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Role;
use Illuminate\Http\Request;

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
      //if hasrole($role)
      
//$userswithrole
      return view('user.list', ['role' => $role])->withUsers($users);//users->dir/..
    }

    /**
     * Show the form for creating a new resource.
     * @param  string $role
     * @return \Illuminate\Http\Response
     */
    public function create(string $role)
    {
        return view('user.create', ['role' => $role]);
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
      $newUser = $request->all();
      // dd($newUser);
      User::create($newUser);
      $user = User::where('email', '=', $newUser['email'])->first();
      $role = Role::where('name', '=', $newUser['role'])->first();
      $user->attachRole($role);
      $user->save();
      \Session::flash('flash_message', $newUser['role']." ".$newUser['name']." successfully added!");
      return redirect()->back();
    }
    /**
     * Display the specified resource.
     * @param  string $role
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(string $role, User $user)
    {
      $userId = $user->id;
      $user = User::findOrFail($userId);
      return view('user.show', ['user' => $user])->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $role
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(string $role, User $user)
    {
      $userId = $user->id;
      $user = User::findOrFail($userId);
      return view('user.edit', ['user' => $user])->withRole($role);
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

      $this->validate($request, [
        'name' => 'required',
        'email' => 'required|unique:users'
      ]);

      $updateUser = $request->all();

      $user->fill($updateUser)->save();
//sprawdzenie roli
      if($user->hasRole("Director")){
          $role = "Director";
      }
      if($user->hasRole("Teacher")){
          $role = "Teacher";
      }
      if($user->hasRole("Student")){
          $role = "Student";
      }
      
      \Session::flash('flash_message', "$role successfully updated!");

      return redirect()->back();
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
        if($user->hasRole("Director")){
            $role = "Director";
        }
        if($user->hasRole("Teacher")){
            $role = "Teacher";
        }
        if($user->hasRole("Student")){
            $role = "Student";
        }
        $user->delete();


        \Session::flash('flash_message', "$role successfully deleted!");

        return redirect()->route('user.list.role', $role);
    }
}
