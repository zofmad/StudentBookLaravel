




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Subject profile</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading lead">{{$subject->name}}</div>

                <div class="panel-body">
                  <p class="lead"> Name: {{$subject->name}} </p>
                  <p class="lead"> Teacher: <a href="{{ route('user.show.role', ['role' => 'Teacher', 'user' => $teacher]) }}">{{$teacher->name}}</a></p>
                  <p class="lead"> Classes:
                    <ul>
                        @foreach($classrooms as $classroom)
                            <li>
                                <a href="{{ route('classrooms.show', $classroom) }}">{{$classroom->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                  </p>


                  <hr>
                  <a href="{{ route('subjects.index') }}" class="btn btn-info">Back to all subjects</a>
                  <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-primary">Edit subject</a>
                  <div class="pull-right">
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['subjects.destroy', $subject]
                    ]) !!}
                        {!! Form::submit("Delete subject", ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                  </div>
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
