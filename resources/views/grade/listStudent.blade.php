
@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Your grades</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">List of Your grades:</div>

                <div class="panel-body">
                  @foreach($gradesSubjectsArray as $subjectId => $grades)


                    <h3>Subject: <a href="{{ route('subjects.show', $subjectsArray[$subjectId]) }}">{{$subjectsArray[$subjectId]->name}}</h3>
                    <ul>
                    @foreach($grades as $grade)
                      <li><a href="{{ route('grades.show', $grade) }}">{{$grade->value}}</a></li>
                    @endforeach
                    </ul>


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
