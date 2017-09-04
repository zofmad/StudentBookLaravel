
@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Grades</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">List of all grades:</div>

                <div class="panel-body">
                  @foreach($grades as $grade)

                    <h3>Student: {{$student[$grade->student_id]->name}}</h3>

                    <p>{{$grade->value}}</p>
                    <p>
                        <a href="{{ route('grades.show', $grade) }}" class="btn btn-info">View grade</a>
                        <a href="{{ route('grades.edit', ['grade' => $grade]) }}" class="btn btn-primary">Edit grade</a>
                    </p>
                    <hr>
                  @endforeach
                </div>

                <a href="{{ route('grades.create') }}" class="btn btn-primary">Add new grade</a>



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
