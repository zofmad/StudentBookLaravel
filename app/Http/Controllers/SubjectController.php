<?php

namespace App\Http\Controllers;
use App\Models\Classroom;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subjects = Subject::all();


      return view('subject.list')->withSubjects($subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $teachers = [];
        foreach($users as $user){
          if($user->hasRole('Teacher')){
            $teachers[] = $user;
          }
        }

        $teachers = array_pluck($teachers, 'email', 'id');

        $classrooms = Classroom::all();
        $classrooms = array_pluck($classrooms, 'name', 'id');

        return view('subject.create')->withTeachers($teachers)->withClassrooms($classrooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
      $this->validate($request, [
        'name' => 'required|unique:subjects',
        'teacher_id' => ['required',
        Rule::notIn(['0'])],
      ]);
      $newSubject = $request->all();

      $subject = Subject::create($newSubject);
      if($request->input('classroom_ids')){
          foreach($request->input('classroom_ids') as $classroomId){
            DB::table('classroom_subject')->insert([
                ['subject_id' => $subject->id, 'classroom_id' => $classroomId]
            ]);
          }
      }

      return redirect()->back()
      ->with('flash_message', 'New subject '.$subject['name'].' successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
      $subjectId = $subject->id;
      $subject = Subject::findOrFail($subjectId);
      $teacher = User::where('id', '=', $subject->teacher_id)->first();

      $classroomIds = DB::table('classroom_subject')
                     ->select('classroom_id')
                     ->where('subject_id', '=', $subject->id)
                     ->get();
      $classroomIds = array_pluck($classroomIds, 'classroom_id');
      $classrooms = Classroom::find($classroomIds);

      return view('subject.show', ['subject' => $subject, 'teacher' => $teacher])->withClassrooms($classrooms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
      $subjectId = $subject->id;
      $subject = Subject::findorFail($subjectId);
      $users = User::all();
      $teachers = [];
      foreach($users as $user){
        if($user->hasRole('Teacher')){
          $teachers[] = $user;
        }
      }

      $classroomRemoveIds = DB::table('classroom_subject')
                   ->select('classroom_id')
                   ->where('subject_id', '=', $subject->id)
                   ->get();
      $classroomRemoveIds = array_pluck($classroomRemoveIds, 'classroom_id');
      $classroomsRemove = Classroom::find($classroomRemoveIds);
      $classroomsRemove = array_pluck($classroomsRemove, 'name', 'id');


      $classroomsAdd = Classroom::whereNotIn('id', $classroomRemoveIds)->get();
      $classroomsAdd = array_pluck($classroomsAdd, 'name', 'id');

      $teachers = array_pluck($teachers, 'email', 'id');
      return view('subject.edit', ['classroomsAdd' => $classroomsAdd, 'classroomsRemove' => $classroomsRemove])->withSubject($subject)->withTeachers($teachers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
      $subjectId = $subject->id;
      $subject = Subject::findorFail($subjectId);
      $this->validate($request, [
        'teacher_id' => 'required|numeric',
        'name' => ['required',
          Rule::unique('subjects')->ignore($subject->id),
      ]
        ]);

      if($request->input('name') == $subject->name && $request->input('teacher_id') == $subject->teacher_id
        && !$request->input('classroom_remove_ids') && !$request->input('classroom_add_ids')){
        return redirect()->back()->with('warning_message', "You didn't change any data.");
      }
      if($request->input('classroom_remove_ids')){

          foreach($request->input('classroom_remove_ids') as $classroomRemoveId){
              DB::table('classroom_subject')->where('subject_id', '=', $subject->id)
                      ->where('classroom_id', '=', $classroomRemoveId)->delete();
          }
      }
      if($request->input('classroom_add_ids')){
          foreach($request->input('classroom_add_ids') as $classroomAddId){
              DB::table('classroom_subject')->insert([
                  ['subject_id' => $subject->id, 'classroom_id' => $classroomAddId]
              ]);
          }
      }
      $updatedSubject = $request->all();
      $subject->fill($updatedSubject)->save();
      return redirect()->back()->with('flash_message', "Subject successfully updated!");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
      $subjectId = $subject->id;
      $subject = Subject::findOrFail($subjectId);
      $subject->delete();
      return redirect()->route('subjects.index')
        ->with('flash_message', "Subject successfully deleted!");
    }
}
