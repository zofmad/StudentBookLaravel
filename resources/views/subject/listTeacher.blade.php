


@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Subjects</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">List of Your subjects grouped by classes:</div>

                <div class="panel-body">
                  @foreach($classroomSubjectTable as $class => $classroomSubject)
                    <h3>Class {{ $class }}</h3>
                    <ul>
                      @foreach($classroomSubject as $subjectName => $subject)
                       <li><a href="{{ route('subjects.show', ['subject' => $subject]) }}">{{$subjectName}}</a></li>

                      @endforeach
                    </ul>
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
