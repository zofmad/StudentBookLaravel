@extends('layouts.app')




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Add a New {{$role}}</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading lead">Enter the personal details of a new director below.</div>

                <div class="panel-body">
                  {!! Form::open([
                      'route' => 'user.store'
                  ]) !!}

                  <div class="form-group">
                      {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                      {!! Form::text('title', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="form-group">
                      {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                      {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                  </div>


                  {!! Form::submit('Create Director', ['class' => 'btn btn-primary']) !!}

                  {!! Form::close() !!}




                </div>
            </div>
        </div>
    </div>
</div>
<!-- <h1>Add a New Task</h1>
<p class="lead">Add to your user list below.</p>
<hr> -->




@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
