




@extends('adminlte::page')

@section('title', 'StudentBook')

@section('content_header')
    <h1>{{$role}} profile</h1>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">



                <div class="panel-heading lead">{{$user->name}}</div>

                <div class="panel-body">
                  <p class="lead"> Name: {{$user->name}} </p>
                  <p class="lead"> Email: {{$user->email}} </p>
                  <hr>
                  <a href="{{ route('user.list.role', $role) }}" class="btn btn-info">Back to all {{$role}}s</a>
                  <a href="{{ route('user.edit.role', ['role' => $role, 'user' => $user]) }}" class="btn btn-primary">Edit {{$role}}</a>
                  <div class="pull-right">
                    <a href="#" class="btn btn-danger">Delete this task</a>
                  </div>

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
