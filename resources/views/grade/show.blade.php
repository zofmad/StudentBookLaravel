




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Grade profile</h1>

@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">



                <div class="panel-body">
                  <p class="lead"> Grade value: {{$grade->value}} </p>
                  <p class="lead"> Note: {{$grade->note}} </p>
                  <p class="lead"> Creation date: {{$grade->created_at}} </p>
                  <p class="lead"> For student: <a href="{{ route('user.show.role', ['role' => 'Student', 'user' => $student]) }}">{{$student->name}}</a></p>
                  <p class="lead"> For subject: <a href="{{ route('subjects.show', $subject) }}">{{$subject->name}}</a></p>
                  <p class="lead"> Added by: <a href="{{ route('user.show.role', ['role' => 'Teacher', 'user' => $teacher]) }}">{{$teacher->name}}</a></p>
                  @permission('see-history-of-changes-for-teacher')
                    <p class="lead"> History of changes:
                      <ol>
                      @foreach($historyOfChanges as $change)
                        <li><b>{{$change->action}}:</b>
                          @if ($change->action == "insert grade")
                            Value: {{$change->value_new}};
                          @else
                            Old value: {{$change->value_old}};
                            New value: {{$change->value_new}};
                          @endif
                          Notes: {{$change->note}};
                          Date of change: {{$change->created_at}};
                        </li>
                      @endforeach
                      </ol>
                    </p>
                  @endpermission

                  <hr>
                  @permission('see-all-grades')
                    <a href="{{ route('grades.index') }}" class="btn btn-info">Back to all grades</a>
                  @endpermission
                  @permission('see-grades-for-student')
                    <a href="{{ route('grades.list.student') }}" class="btn btn-info">Back to Your grades</a>
                  @endpermission
                  @permission('insert/update-grade-for-subject')
                    <a href="{{ route('grades.list.teacher') }}" class="btn btn-info">Back to Your grades</a>
                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-primary">Edit grade</a>
                    <div class="pull-right">
                      {!! Form::open([
                          'method' => 'DELETE',
                          'route' => ['grades.destroy', $grade]
                      ]) !!}
                          {!! Form::submit("Delete grade", ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                    </div>
                  @endpermission
          







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
