@extends('layouts.app')




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>{{$role}}s</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-heading lead">List of all {{$role}}s:</div>

                <div class="panel-body">
                  @foreach($users as $user)
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->email}}</p>
                    <p>
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-info">View {{$role}}</a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit {{$role}}</a>
                    </p>
                    <hr>
                  @endforeach






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
