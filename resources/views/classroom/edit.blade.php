



@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Edit class</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">Edit class {{$classroom->name}}</div>

                    @include('partials.alerts.errors')



                <div class="panel-body">
                  {!! Form::model($classroom, [
                      'method' => 'PATCH',
                      'route' => ['classrooms.update', $classroom]
                  ]) !!}
                  <div class="form-group">
                      {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                      {!! Form::text('name', null, ['class' => 'form-control']) !!}
                  </div>



                  {!! Form::submit('Update Class', ['class' => 'btn btn-primary']) !!}

                  {!! Form::close() !!}



                  <hr>
                  <a href="{{ route('classrooms.index') }}" class="btn btn-info">Back to all classes</a>


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
