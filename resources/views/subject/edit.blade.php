



@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Edit subject</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">Edit subject {{$subject->name}}</div>

                    @include('partials.alerts.errors')



                <div class="panel-body">
                  {!! Form::model($subject, [
                      'method' => 'PATCH',
                      'route' => ['subjects.update', $subject]
                  ]) !!}
                  <div class="form-group">
                      {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                      {!! Form::text('name', null, ['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('teacher', 'Teacher:', ['class' => 'control-label']) !!}
                      {!! Form::select('teacher_id', $teachers, null, ['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('classrooms_add', 'Assign subject to classes:(Ctrl+click)', ['class' => 'control-label']) !!}
                    {!! Form::select('classroom_add_ids[]', $classroomsAdd, null, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('classrooms_remove', 'Remove subject from classes:(Ctrl+click)', ['class' => 'control-label']) !!}
                    {!! Form::select('classroom_remove_ids[]', $classroomsRemove, null, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
                  </div>



                  {!! Form::submit('Update subject', ['class' => 'btn btn-primary']) !!}

                  {!! Form::close() !!}



                  <hr>
                  <a href="{{ route('subjects.index') }}" class="btn btn-info">Back to all subjects</a>


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
