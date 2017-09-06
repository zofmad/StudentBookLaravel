
@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Your history of changes</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">List of grades changes:</div>

                <div class="panel-body">
                  @foreach($historyOfChanges as $change)
                    <h4 style="color: red"><b>{{$change->action}}:</b></h4>


                  @if ($change->grade_id)
                    <p>Grade: <a href="{{ route('grades.show', $gradesArray[$change->grade_id]) }}">{{$gradesArray[$change->grade_id]->value}}</a></p>
                  @endif
                  @if ($change->action == "insert grade")
                    <p>Value: {{$change->value_new}}</p>
                  @else
                  <p>Old value: {{$change->value_old}}</p>
                    @if ($change->action == "change grade")
                    <p>New value: {{$change->value_new}}</p>
                    @endif
                  @endif
                  <p>Notes: {{$change->note}}</p>
                  <p>Student: <a href="{{ route('user.show.role', ['role' => "Student", 'user' => $studentsArray[$change->student_id]]) }}">{{$studentsArray[$change->student_id]->name}}</a></p>
                  <p>Subject: <a href="{{ route('subjects.show', $subjectsArray[$change->subject_id]) }}">{{$subjectsArray[$change->subject_id]->name}}</a></p>
                  <p>Date of change: {{$change->created_at}}</p>

                  <hr>
                  @endforeach
                </div>
                <a href="{{ route('grades.list.teacher') }}" class="btn btn-info">Back to Your grades</a>



            </div>
        </div>
    </div>
</div>




@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
