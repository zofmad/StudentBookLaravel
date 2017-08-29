<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $classrooms = Classroom::all();


      return view('classroom.list')->withClassrooms($classrooms);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('classroom.create');
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
        'name' => 'required|unique:classrooms',
      ]);
      $newClassroom = $request->all();

      $classroom = Classroom::create($newClassroom);
      return redirect()->back()
      ->with('flash_message', 'New class '.$classroom['name'].' successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
      $classroomId = $classroom->id;
      $classroom = Classroom::findOrFail($classroomId);
      return view('classroom.show', ['classroom' => $classroom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        $classroomId = $classroom->id;
        $classroom = Classroom::findorFail($classroomId);
        return view('classroom.edit')->withClassroom($classroom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $classroomId = $classroom->id;
        $classroom = Classroom::findOrFail($classroomId);
        $this->validate($request, [
          'name' => ['required',
            Rule::unique('classrooms')->ignore($classroom->id),
        ]
          ]);

        if($request->input('name') == $classroom->name){
          return redirect()->back()->with('warning_message', "You didn't change any data.");
        }
        $updatedClassroom = $request->all();
        $classroom->fill($updatedClassroom)->save();
        return redirect()->back()->with('flash_message', "Class successfully updated!");



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroomId = $classroom->id;
        $classroom = Classroom::findOrFail($classroomId);
        $classroom->delete();
        return redirect()->route('classrooms.index')
          ->with('flash_message', "Class successfully deleted!");
    }
}
