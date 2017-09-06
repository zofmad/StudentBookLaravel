<?php

namespace App\Http\Controllers;

use App\Models\GradesHistory;
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
      $users = User::all();
      $students = [];
      foreach($users as $user){
        if($user->hasRole('Student')){
          $students[$user->id] = $user;
        }
      }



      return view('grade.list')->withGrades($grades)->withStudents($students);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForTeacher()
    {
      if(\Auth::user()->can('see-grades-for-teacher')){
        $teacherId = \Auth::user()->id;
        $subjects = Subject::where('teacher_id', "=", $teacherId)->get();
        $subjectsIds = array_pluck($subjects, 'id');
        $grades = Grade::whereIn('subject_id', $subjectsIds)->get();
        $users = User::all();
        $students = [];
        foreach($users as $user){
          if($user->hasRole('Student')){
            $students[$user->id] = $user;
          }
        }


        return view('grade.listTeacher')->withGrades($grades)->withStudents($students);


      }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {




      if(\Auth::user()->can('insert/update-grade-for-subject')){
        $teacherId = \Auth::user()->id;
        $subjects = Subject::where('teacher_id', "=", $teacherId)->get();
        $subjectsIds = array_pluck($subjects, 'id');
        $subjects = array_pluck($subjects, 'name', 'id');
        $classroomIds= \DB::table('classroom_subject')
                     ->select('classroom_id')
                     ->whereIn('subject_id', $subjectsIds)
                     ->get();

        $classroomIds = array_pluck($classroomIds, 'classroom_id');

        $users = User::where('usertable_type', '=', 'class')->whereIn('usertable_id', $classroomIds)->get();
        $students = [];
        foreach($users as $user){
          if($user->hasRole('Student')){
            $students[] = $user;
          }
        }
        $students = array_pluck($students, 'name', 'id');

        $grades = range(1,6);
        array_unshift($grades, "Select grade");
        return view('grade.create', ['grades' => $grades])->withStudents($students)->withSubjects($subjects);

      }


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
        'student_id' => 'required|numeric|min:1',
        'subject_id' => 'required|numeric|min:1',
        'value' => 'required|numeric|min:1|max:11',
      ]);

      $classroomId = \DB::table('users')
                   ->select('usertable_id')
                   ->where('id', $request->input('student_id'))
                   ->first()->usertable_id;

      $subjectIds = \DB::table('classroom_subject')
                   ->select('subject_id')
                   ->where('classroom_id', $classroomId)
                   ->get();


      $subjectIds = array_pluck($subjectIds, 'subject_id');
      $studentName = User::find($request->input('student_id'))->name;
      if(!in_array($request->input('subject_id'), $subjectIds)){
        return redirect()->back()->with('warning_message', "Student $studentName is not enrolled in chosen subject. Try again");
      }

      $newGrade = $request->all();

      $grade = Grade::create($newGrade);


      if(\Auth::user()->hasRole('Teacher')){

        \DB::table('grades_histories')->insert([
            ['grade_id' => $grade->id, 'teacher_id' => \Auth::user()->id,
            'student_id' => $grade->student_id, 'subject_id' => $grade->subject_id,
            'note' => $grade->note, 'value_new' => $request->input('value'),
            'action' => 'insert grade', 'created_at' => date("Y-m-d H:i:s")]
        ]);
      }



      return redirect()->back()
      ->with('flash_message', 'New grade:'.$grade['value'].' for student '.$studentName.' successfully added!');
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
      $historyOfChanges = GradesHistory::where('grade_id', '=', $grade->id)->get();

      return view('grade.show', ['historyOfChanges' => $historyOfChanges, 'grade' => $grade, 'student' => $student, 'subject' => $subject, 'teacher' => $teacher]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
      $gradeId = $grade->id;
      $grade = Grade::findorFail($gradeId);
      // $users = User::all();
      // $teachers = [];
      // foreach($users as $user){
      //   if($user->hasRole('Teacher')){
      //     $teachers[] = $user;
      //   }
      // }
      //
      // $teachers = array_pluck($teachers, 'email', 'id');

      if(\Auth::user()->can('insert/update-grade-for-subject')){
        $teacherId = \Auth::user()->id;
        $subjects = Subject::where('teacher_id', "=", $teacherId)->get();
        $subjectsIds = array_pluck($subjects, 'id');
        $subjects = array_pluck($subjects, 'name', 'id');
        $classroomIds= \DB::table('classroom_subject')
                     ->select('classroom_id')
                     ->whereIn('subject_id', $subjectsIds)
                     ->get();

        $classroomIds = array_pluck($classroomIds, 'classroom_id');

        $users = User::where('usertable_type', '=', 'class')->whereIn('usertable_id', $classroomIds)->get();
        $students = [];
        foreach($users as $user){
          if($user->hasRole('Student')){
            $students[] = $user;
          }
        }
        $students = array_pluck($students, 'name', 'id');

        $grades = range(1,6);
        array_unshift($grades, "Select grade");

        return view('grade.edit', ['grades' => $grades])->withGrade($grade);

      }

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

      $gradeId = $grade->id;
      $grade = Grade::findorFail($gradeId);

      $this->validate($request, [
        'student_id' => 'required|numeric|min:1',
        'subject_id' => 'required|numeric|min:1',
        'value' => 'required|numeric|min:1|max:6',
      ]);
      if($request->input('value') == $grade->value && $request->input('note') == $grade->note){
        return redirect()->back()->with('warning_message', "You didn't change any data.");
      }

      $updatedGrade = $request->all();

      if(\Auth::user()->hasRole('Teacher')){

        \DB::table('grades_histories')->insert([
            ['grade_id' => $grade->id, 'teacher_id' => \Auth::user()->id,
            'student_id' => $grade->student_id, 'subject_id' => $grade->subject_id,
            'note' => $request->input('note').','.$grade->note, 'value_old' => $grade->value, 'value_new' => $request->input('value'),
            'action' => 'change grade', 'created_at' => date("Y-m-d H:i:s")]
        ]);
      }
      $grade->fill($updatedGrade)->save();

      return redirect()->back()->with('flash_message', "Grade successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
      $gradeId = $grade->id;
      $grade = Grade::findOrFail($gradeId);
      if(\Auth::user()->hasRole('Teacher')){

        \DB::table('grades_histories')->insert([
            ['grade_id' => $grade->id, 'teacher_id' => \Auth::user()->id,
            'student_id' => $grade->student_id, 'subject_id' => $grade->subject_id,
            'note' => $grade->note, 'value_old' => $grade->value, 'value_new' => 0,
            'action' => 'delete grade', 'created_at' => date("Y-m-d H:i:s")]
        ]);
      }
      $grade->delete();
      return redirect()->route('grades.index')
        ->with('flash_message', "Grade successfully deleted!");

    }
    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function showGradesHistoryForTeacher()
    {
      if(\Auth::user()->can('see-history-of-changes-for-teacher')){
        $historyOfChanges = GradesHistory::where('teacher_id', '=', \Auth::user()->id)
        ->orderBy('id', 'DESC')->get();
        $teacher = User::find(\Auth::user()->id);
        $users = User::all();
        $studentsArray = [];
        foreach($users as $user){
          if($user->hasRole('Student')){
            $studentsArray[$user->id] = $user;
          }
        }

        $subjects = Subject::all();
        $grades = Grade::all();
        foreach($subjects as $subject){
          $subjectsArray[$subject->id] = $subject;
        }
        foreach($grades as $grade){
          $gradesArray[$grade->id] = $grade;
        }
        return view('grade.showHistoryForTeacher',
        ['historyOfChanges' => $historyOfChanges, 'studentsArray' => $studentsArray,
        'subjectsArray' => $subjectsArray, 'teacher' => $teacher, 'gradesArray' => $gradesArray]);
        }


      }
      public function showGradesForstudent()
      {
        if(\Auth::user()->can('see-grades-for-student')){
          $grades = Grade::where('student_id', '=', \Auth::user()->id)->get();
          foreach($grades as $grade){
            $gradesSubjectsArray[$grade->subject_id][]= $grade;
          }


          $subjects = Subject::all();

          foreach($subjects as $subject){
            $subjectsArray[$subject->id] = $subject;
          }

          return view('grade.listStudent',
          ['gradesSubjectsArray' => $gradesSubjectsArray, 'subjectsArray' => $subjectsArray]);
        }


      }











}
