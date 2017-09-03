



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
                  <div class="form-group">
                    {!! Form::label('students', 'Add students:(Ctrl+click)', ['class' => 'control-label']) !!}
                    {!! Form::select('student_ids[]', $students, null, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('subjects_add', 'Add subjects to class:(Ctrl+click)', ['class' => 'control-label']) !!}
                    {!! Form::select('subject_add_ids[]', $subjectsAdd, null, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('subjects_remove', 'Delete subjects from class:(Ctrl+click)', ['class' => 'control-label']) !!}
                    {!! Form::select('subject_remove_ids[]', $subjectsRemove, null, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
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
