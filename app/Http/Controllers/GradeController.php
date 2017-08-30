<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $grades = Grade::all();
      return view('grade.list')->withGrades($grades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // $users = User::all();
      // $teachers = [];
      // foreach($users as $user){
      //   if($user->hasRole('Teacher')){
      //     $teachers[] = $user;
      //   }
      // }
      //
      // $teachers = array_pluck($teachers, 'email', 'id');
      // return view('grade.create')->withTeachers($teachers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //     // dd($request);
      // $this->validate($request, [
      //   'name' => 'required|unique:grades',
      //   'teacher_id' => ['required',
      //   Rule::notIn(['0'])],
      // ]);
      // $newGrade = $request->all();
      //
      // $grade = Grade::create($newGrade);
      //
      // return redirect()->back()
      // ->with('flash_message', 'New grade '.$grade['name'].' successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
      $gradeId = $grade->id;
      $grade = Grade::findOrFail($gradeId);
      $student = User::where('id', '=', $grade->student_id)->first();
      $subject = Subject::where('id', '=', $grade->subject_id)->first();
      $teacher = User::where('id', '=', $subject->teacher_id)->first();

      return view('grade.show', ['grade' => $grade, 'student' => $student, 'subject' => $subject, 'teacher' => $teacher]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
      // $gradeId = $grade->id;
      // $grade = Grade::findorFail($gradeId);
      // $users = User::all();
      // $teachers = [];
      // foreach($users as $user){
      //   if($user->hasRole('Teacher')){
      //     $teachers[] = $user;
      //   }
      // }
      //
      // $teachers = array_pluck($teachers, 'email', 'id');
      // return view('grade.edit')->withGrade($grade)->withTeachers($teachers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
      // $gradeId = $grade->id;
      // $grade = Grade::findorFail($gradeId);
      // $this->validate($request, [
      //   'teacher_id' => 'required|numeric',
      //   'name' => ['required',
      //     Rule::unique('grades')->ignore($grade->id),
      // ]
      //   ]);
      //
      // if($request->input('name') == $grade->name && $request->input('teacher_id') == $grade->teacher_id){
      //   return redirect()->back()->with('warning_message', "You didn't change any data.");
      // }
      // $updatedGrade = $request->all();
      // $grade->fill($updatedGrade)->save();
      // return redirect()->back()->with('flash_message', "Grade successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
      // $gradeId = $grade->id;
      // $grade = Grade::findOrFail($gradeId);
      // $grade->delete();
      // return redirect()->route('grades.index')
      //   ->with('flash_message', "Grade successfully deleted!");
    }
}
