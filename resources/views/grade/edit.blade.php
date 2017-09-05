



@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Edit grade</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">Edit grade</div>

                    @include('partials.alerts.errors')



                <div class="panel-body">
                  {!! Form::model($grade, [
                      'method' => 'PATCH',
                      'route' => ['grades.update', $grade]
                  ]) !!}
                  <div class="form-group">
                  {!! Form::label('value', 'Grade:', ['class' => 'control-label']) !!}
                  {!! Form::select('value', $grades, null, ['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                  {!! Form::label('note', 'Note:', ['class' => 'control-label']) !!}
                  {!! Form::text('note', null, ['class' => 'form-control']) !!}
                  </div>
                  {!! Form::hidden('student_id', $grade->student_id) !!}
                  {!! Form::hidden('subject_id', $grade->subject_id) !!}
                  {!! Form::submit('Update grade', ['class' => 'btn btn-primary']) !!}

                  {!! Form::close() !!}



                  <hr>
                  <a href="{{ route('grades.list.teacher') }}" class="btn btn-info">Back to Your grades</a>


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
