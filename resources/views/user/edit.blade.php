



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


                @role('Director')
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
                        {!! Form::hidden('role', $role) !!}
                    </div>

                    @if($role == 'Teacher')
                      <div class="form-group">
                          {!! Form::label('subject', 'Assign subjects(Ctrl+click):', ['class' => 'control-label']) !!}
                          {!! Form::select('subject_ids[]', $subjects, null, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
                      </div>
                    @elseif($role == 'Student')
                      <div class="form-group">
                          {!! Form::label('class', 'Add to class:', ['class' => 'control-label']) !!}
                          {!! Form::select('usertable_id', $classes, null, ['class' => 'form-control']) !!}
                          {!! Form::hidden('usertable_type', "class") !!}
                      </div>

                    @endif

                    {!! Form::submit("Update $role", ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}



                    <hr>
                    @if($role != "me")
                    <a href="{{ route('user.list.role', $role) }}" class="btn btn-info">Back to all {{$role}}s</a>
                    @endif

                  </div>
                  @endrole
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
