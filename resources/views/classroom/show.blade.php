




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Class profile</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading lead">{{$classroom->name}}</div>

                <div class="panel-body">
                  <p class="lead"> Name: {{$classroom->name}} </p>
                  <p class="lead"> Students:
                  <ul>
                  @foreach($students as $student)
                  <li>
                      <a href="{{ route('user.show.role', ['role' => "Student", 'user' => $student]) }}">{{$student->name}}</a>
                  </li>
                  @endforeach
                  </ul>
                  </p>
                   <p class="lead"> Subjects:
                  <ul>
                  @foreach($subjects as $subject)
                  <li>
                      <a href="{{ route('subjects.show', $subject) }}">{{$subject->name}}</a>
                  </li>
                  @endforeach
                  </ul>
                  </p>

                  <hr>
                  @permission('classes-CRUD')
                    <a href="{{ route('classrooms.index') }}" class="btn btn-info">Back to all classes</a>
                    <a href="{{ route('classrooms.edit', $classroom) }}" class="btn btn-primary">Edit class</a>
                    <div class="pull-right">
                      {!! Form::open([
                          'method' => 'DELETE',
                          'route' => ['classrooms.destroy', $classroom]
                      ]) !!}
                          {!! Form::submit("Delete class", ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                    </div>
                  @endpermission
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
