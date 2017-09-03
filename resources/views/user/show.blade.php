




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    @if($role != "me")
    <h1>{{$role}}
    @else
    <h1>My
    @endif
    profile</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">



                <div class="panel-heading lead">{{$user->name}}</div>

                <div class="panel-body">
                  <p class="lead"> Name: {{$user->name}} </p>
                  <p class="lead"> Email: {{$user->email}} </p>
                  @if($role == 'Student')
                    <p class="lead"> Class: <a href="{{ route('classrooms.show', $class) }}">{{$class->name}}</a> </p>
                  @endif
                  @if($role == 'Teacher')
                    <p class="lead"> Subjects:
                        <ul>
                        @foreach($subjects as $subject)
                            <li><a href="{{ route('subjects.show', $subject) }}">{{$subject->name}}</a></li>
                        @endforeach
                        </ul>
                    </p>
                  @endif
                  <a href="{{ route('user.changePassword.role', ['role' => $role, 'user' => $user]) }}" class="pull-right btn" style="color: black">Change password</a>
                  <br>

                  <hr>

                  @if($role != "me" || \Entrust::hasRole('Director'))
                    @if($role != "me")
                      <a href="{{ route('user.list.role', $role) }}" class="btn btn-info">Back to all {{$role}}s</a>
                    @endif


                    <a href="{{ route('user.edit.role', ['role' => $role, 'user' => $user]) }}" class="btn btn-primary">Edit profile</a>

                    <div class="pull-right">
                      {!! Form::open([
                          'method' => 'DELETE',
                          'route' => ['user.destroy', $user]
                      ]) !!}
                          {!! Form::hidden('role', $role) !!}
                          {!! Form::submit("Delete $role", ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                    </div>

                  @endif
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
