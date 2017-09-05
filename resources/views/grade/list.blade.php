
@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Grades</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">List of all grades:</div>

                <div class="panel-body">
                  @foreach($grades as $grade)

                    <h3>Student: <a href="{{ route('user.show.role', ['user' => $students[$grade->student_id], 'role' => 'Student']) }}">{{ $students[$grade->student_id]->name }}</a></h3>

                    <h3 style = "color: red">{{$grade->value}}</h3>
                    <p>
                        <a href="{{ route('grades.show', $grade) }}" class="btn btn-info">View grade</a>

                    <hr>
                  @endforeach
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
