<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        return view('subject.create')->withTeachers($teachers);
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
      return view('subject.show', ['subject' => $subject, 'teacher' => $teacher]);
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

      $teachers = array_pluck($teachers, 'email', 'id');
      return view('subject.edit')->withSubject($subject)->withTeachers($teachers);
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

      if($request->input('name') == $subject->name && $request->input('teacher_id') == $subject->teacher_id){
        return redirect()->back()->with('warning_message', "You didn't change any data.");
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
