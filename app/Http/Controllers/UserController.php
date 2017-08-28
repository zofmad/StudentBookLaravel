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

      $usersWithRole = [];
      for($i=0; $i<count($users); $i++){
        if($users[$i]->hasRole($role)){
          $usersWithRole[] = $users[$i];
        }
      }
      return view('user.list', ['role' => $role])->withUsers($usersWithRole);
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

      $user = User::create($newUser);
      $role = Role::where('name', '=', $newUser['role'])->first();
      $user->attachRole($role);
      $user->save();
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


      if($request['email'] == $user->email && !($request['name'] == $user->name)){
        $this->validate($request, [
          'name' => 'required',
          'email' => 'required'
        ]);
      } elseif($request['email'] == $user->email && $request['name'] == $user->name) {

        return redirect()->back()->with('warning_message', "You didn't change any data.");

      } else {
        $this->validate($request, [
          'name' => 'required',
          'email' => 'required|unique:users'
        ]);
      }

      $updateUser = $request->all();
      $role = $user->roles->first()->name;

      $user->fill($updateUser)->save();



      return redirect()->back()->with('flash_message', "$role successfully updated!");
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
        $user->delete();

        return redirect()->route('user.list.role', $role)
          ->with('flash_message', "$role successfully deleted!");
    }
}
