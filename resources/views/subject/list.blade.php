


@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>Subjects</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">List of all subjects:</div>

                <div class="panel-body">
                  @foreach($subjects as $subject)
                    <h3>{{ $subject->name }}</h3>
                    <p></p>
                    <p>
                        <a href="{{ route('subjects.show', ['subject' => $subject]) }}" class="btn btn-info">View subject</a>
                        <a href="{{ route('subjects.edit', ['subject' => $subject]) }}" class="btn btn-primary">Edit subject</a>
                    </p>
                    <hr>
                  @endforeach






                </div>
                <a href="{{ route('subjects.create') }}" class="btn btn-primary">Add new subject</a>


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
