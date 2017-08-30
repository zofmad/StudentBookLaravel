




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Grade profile</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">



                <div class="panel-body">
                  <p class="lead"> Grade value: {{$grade->value}} </p>
                  <p class="lead"> Note: {{$grade->note}} </p>
                  <p class="lead"> Date: {{$grade->created_at}} </p>
                  <p class="lead"> For student: <a href="{{ route('user.show.role', ['role' => 'Student', 'user' => $student]) }}">{{$student->name}}</a></p>
                  <p class="lead"> For subject: <a href="{{ route('subjects.show', $subject) }}">{{$subject->name}}</a></p>
                  <p class="lead"> Added by: <a href="{{ route('user.show.role', ['role' => 'Teacher', 'user' => $teacher]) }}">{{$teacher->name}}</a></p>
                  <hr>
                  <a href="{{ route('grades.index') }}" class="btn btn-info">Back to all grades</a>

                </div>
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
