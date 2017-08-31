



@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
  @if($role != "me")
    <h1>{{$role}}
  @else
    <h1>My
  @endif
password</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">Change {{$user->name}} password </div>

                    @include('partials.alerts.errors')



                <div class="panel-body">
                  {!! Form::open([
                      'route' => ['user.updatePassword', 'user' => $user]
                  ]) !!}
                  @if(!Entrust::can('users-CRUD'))
                    <div class="form-group">
                        {!! Form::label('old_password', 'Old password:', ['class' => 'control-label']) !!}
                        {!! Form::text('old_password', null, ['class' => 'form-control']) !!}
                    </div>
                  @endif
                  <div class="form-group">
                      {!! Form::label('password', 'New password:', ['class' => 'control-label']) !!}
                      {!! Form::text('password', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="form-group">
                      {!! Form::label('repeat_password', 'Repeat password:', ['class' => 'control-label']) !!}
                      {!! Form::text('repeat_password', null, ['class' => 'form-control']) !!}
                      {!! Form::hidden('role', $role) !!}
                      {!! Form::hidden('user', $user) !!}
                  </div>

                  {!! Form::submit("Change password", ['class' => 'btn btn-primary']) !!}

                  {!! Form::close() !!}



                  <hr>
                  @if($role != "me")
                  <a href="{{ route('user.list.role', $role) }}" class="btn btn-info">Back to all {{$role}}s</a>
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
