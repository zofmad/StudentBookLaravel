




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Add a New class</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              @include('partials.alerts.errors')




                <div class="panel-heading lead">Enter the details of a new class below.</div>

                <div class="panel-body">



                  {!! Form::open([
                      'route' => 'classrooms.store'
                  ]) !!}

                  <div class="form-group">
                      {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                      {!! Form::text('name', null, ['class' => 'form-control']) !!}
                  </div>

                  {!! Form::submit("Create class", ['class' => 'btn btn-primary']) !!}
                  <a href="{{ route('classrooms.index') }}" class="btn btn-info">Back to all classes</a>

                  {!! Form::close() !!}




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
