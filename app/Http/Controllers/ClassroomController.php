<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

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
      $students = User::where("usertable_type", "=", "class")->get();
      $students = array_pluck($students, 'name', 'id');

      $subjects = Subject::all();
      $subjects = array_pluck($subjects, 'name', 'id');

      
      return view('classroom.create')->withStudents($students)->withSubjects($subjects);
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
      if($request->input('student_ids')){
        $studentIds = $request->input('student_ids');
        foreach($studentIds as $studentId){
            $user = User::where('id', '=', $studentId)->first();
            $user->usertable_id = $classroom->id;
            $user->save();
        }    
      }
      if($request->input('subject_ids')){
          foreach($request->input('subject_ids') as $subjectId){
            DB::table('classroom_subject')->insert([
                ['classroom_id' => $classroom->id, 'subject_id' => $subjectId]
            ]);
        }  
        
      
      }
      
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
      
      $students = User::where("usertable_type", "=", "class")
              ->where("usertable_id", "=", $classroom->id)->orderBy('name', 'asc')->get();
      

      $subjectIds = DB::table('classroom_subject')
                     ->select('subject_id')
                     ->where('classroom_id', '=', $classroom->id)
                     ->get();
      $subjectIds = array_pluck($subjectIds, 'subject_id');
      $subjects = Subject::find($subjectIds);
      return view('classroom.show', ['classroom' => $classroom, 'subjects' => $subjects])->withStudents($students);
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
        $students = User::where('usertable_type', '=', 'class')
                ->where('usertable_id', '!=', $classroom->id)->get();
        $students = array_pluck($students, 'name', 'id');
        
        $subjectRemoveIds = DB::table('classroom_subject')
                     ->select('subject_id')
                     ->where('classroom_id', '=', $classroom->id)
                     ->get();
        $subjectRemoveIds = array_pluck($subjectRemoveIds, 'subject_id');
        $subjectsRemove = Subject::find($subjectRemoveIds);
        $subjectsRemove = array_pluck($subjectsRemove, 'name', 'id');
        
        $subjectAddIds = DB::table('classroom_subject')
                     ->select('subject_id')
                     ->where('classroom_id', '!=', $classroom->id)
                     ->whereNotIn('subject_id', $subjectRemoveIds)
                     ->get();
        $subjectAddIds = array_pluck($subjectAddIds, 'subject_id');
        $subjectsAdd = Subject::find($subjectAddIds);
        $subjectsAdd = array_pluck($subjectsAdd, 'name', 'id');
        
        
        return view('classroom.edit', ['subjectsAdd' => $subjectsAdd, 'subjectsRemove' => $subjectsRemove])
                ->withClassroom($classroom)->withStudents($students);
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

        if($request->input('name') == $classroom->name && !$request->input('student_ids') 
                && !$request->input('subject_remove_ids') && !$request->input('subject_add_ids')){
          return redirect()->back()->with('warning_message', "You didn't change any data.");
        }
        if($request->input('student_ids')){
            $studentIds = $request->input('student_ids');
            foreach($studentIds as $studentId){
                $user = User::where('id', '=', $studentId)->first();
                $user->usertable_type = 'class';

                $user->usertable_id = $classroom->id;
                $user->save();
            }    
        }
        if($request->input('subject_remove_ids')){
           
            foreach($request->input('subject_remove_ids') as $subjectRemoveId){
                DB::table('classroom_subject')->where('classroom_id', '=', $classroom->id)
                        ->where('subject_id', '=', $subjectRemoveId)->delete();
            }    
        }
        if($request->input('subject_add_ids')){
            foreach($request->input('subject_add_ids') as $studentAddId){
                DB::table('classroom_subject')->insert([
                    ['classroom_id' => $classroom->id, 'subject_id' => $studentAddId]
                ]);
            }    
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
