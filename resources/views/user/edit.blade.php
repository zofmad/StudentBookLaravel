




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Edit {{$role}}</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">Edit {{$user->name}}</div>

                    @include('partials.alerts.errors')



                <div class="panel-body">
                  {!! Form::model($user, [
                      'method' => 'PATCH',
                      'route' => ['user.update', $user]
                  ]) !!}
                  <div class="form-group">
                      {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                      {!! Form::text('name', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="form-group">
                      {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                      {!! Form::email('email', null, ['class' => 'form-control']) !!}

                  </div>

                  {!! Form::submit('Update Task', ['class' => 'btn btn-primary']) !!}

                  {!! Form::close() !!}



                  <hr>
                  <a href="{{ route('user.list.role', $role) }}" class="btn btn-info">Back to all {{$role}}s</a>


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
